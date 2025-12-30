<?php

namespace App\Http\Controllers\View\Admin;

use App\Helpers\GlobalSettings;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BugStatusStoreRequest;
use App\Http\Requests\Admin\BugStatusUpdateRequest;
use App\Http\Requests\Admin\RoleStoreRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;
use App\Http\Requests\Admin\WebSettingUpdateRequest;
use App\Models\BugStatus;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(): Factory|View
    {
        return view('admin.dashboard', [
            'roles' => Role::query()->orderBy('id')->get(),
            '_settings' => Setting::query()->orderBy('key')->get(),
            'bugStatuses' => BugStatus::query()->orderBy('sort_order')->orderBy('label')->get(),
        ]);
    }

    // Roles

    public function updateRole(RoleUpdateRequest $request, Role $role): RedirectResponse
    {
        $data = $request->validated();

        if (in_array($role->name, ['user', 'admin'], true)) {
            unset($data['name']);
        }

        $role->update($data);

        return back()->with('status', 'role-updated');
    }

    public function deleteRole(Role $role): RedirectResponse
    {
        $fallback = Role::query()->where('name', GlobalSettings::get(GlobalSettings::DefaultRole))->firstOrFail();

        if ($role->id === $fallback->id) {
            abort(422, 'Negalima panaikinti user rolės.');
        }

        if ($role->name === 'admin') {
            abort(422, 'Negalima panaikinti admin rolės.');
        }

        DB::transaction(function () use ($role, $fallback) {
            User::query()
                ->where('role_id', $role->id)
                ->update(['role_id' => $fallback->id]);
            $role->delete();
        });

        return back();
    }

    public function storeRole(RoleStoreRequest $request): RedirectResponse
    {
        Role::query()->create($request->validated());
        return back(201)->with('status', 'role-created');
    }

    // Bug statuses

    public function storeBugStatus(BugStatusStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active']  = (bool)($data['is_active'] ?? true);

        BugStatus::query()->create($data);
        return back()->with('status', 'bugstatus-created');
    }

    public function updateBugStatus(BugStatusUpdateRequest $request, BugStatus $bugStatus): RedirectResponse
    {
        $data = $request->validated();
        $data['sort_order'] = $data['sort_order'] ?? 0;
        $data['is_active']  = (bool)($data['is_active'] ?? false);

        $bugStatus->update($data);
        return back()->with('status', 'bugstatus-updated');
    }

    public function destroyBugStatus(BugStatus $bugStatus): RedirectResponse
    {
        $bugStatus->delete();
        return back()->with('status', 'bugstatus-deleted');
    }

    // Website global settings

    public function updateSetting(WebSettingUpdateRequest $request, Setting $setting): RedirectResponse
    {
        GlobalSettings::clearCache();
        $setting->update(['value' => $request->validated()['value']]);
        return back()->with('status', 'setting-updated');
    }
}
