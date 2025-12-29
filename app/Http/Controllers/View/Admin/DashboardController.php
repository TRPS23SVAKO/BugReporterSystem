<?php

namespace App\Http\Controllers\View\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleStoreRequest;
use App\Http\Requests\Admin\RoleUpdateRequest;
use App\Http\Requests\Admin\WebSettingUpdateRequest;
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
        ]);
    }

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
        $fallback = Role::query()->where('name', 'user')->firstOrFail();

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

    public function updateSetting(WebSettingUpdateRequest $request, Setting $setting): RedirectResponse
    {
        cache()->forget('settings.all');
        $setting->update(['value' => $request->validated()['value']]);
        return back()->with('status', 'setting-updated');
    }
}
