<?php

namespace App\Http\Requests\Admin;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Role $role */
        $role = $this->route('role');
        $isSystem = in_array($role->name, ['user', 'admin'], true);
        return [
            'name' => array_merge(
                $isSystem ? ['prohibited'] : ['required','string','max:25'],
                [Rule::unique('roles', 'name')->ignore($role->id)]
            ),
            'display_name' => ['required','string','max:25'],
            'role_color'   => ['required','regex:/^[0-9A-Fa-f]{6}$/'],
        ];
    }
}
