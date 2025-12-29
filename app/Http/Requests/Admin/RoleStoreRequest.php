<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:25',
                'regex:/^[a-z0-9_-]+$/',
                Rule::unique('roles', 'name'),
                Rule::notIn(['user', 'admin']),
            ],
            'display_name' => ['required','string','max:25'],
            'role_color'   => ['required','regex:/^[0-9A-Fa-f]{6}$/'],
        ];
    }
}
