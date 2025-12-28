<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:50', 'unique:tags,name'],
            'color' => ['nullable', 'string', 'size:6', 'regex:/^[0-9A-Fa-f]{6}$/'],
        ];
    }
}
