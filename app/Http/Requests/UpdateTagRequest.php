<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $tagId = $this->route('tag')?->id ?? $this->route('tag');

        return [
            'name' => ['sometimes', 'required', 'string', 'max:50', Rule::unique('tags', 'name')->ignore($tagId)],
            'color' => ['sometimes', 'nullable', 'string', 'size:6', 'regex:/^[0-9A-Fa-f]{6}$/'],
        ];
    }
}
