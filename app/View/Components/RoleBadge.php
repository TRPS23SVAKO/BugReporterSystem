<?php

namespace App\View\Components;

use App\Models\Role;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RoleBadge extends Component
{
    public ?Role $role;

    public function __construct(public int $roleId = 0)
    {
        $this->role = Role::query()->select(['id', 'name', 'display_name', 'role_color'])->find($this->roleId);
    }

    public function render(): View|Closure|string
    {
        return view('components.role-badge');
    }
}
