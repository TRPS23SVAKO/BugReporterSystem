<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCommentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'bug_id' => ['required', 'integer', 'exists:bugs,id'],
            'parent_id' => ['nullable', 'integer', 'exists:comments,id'],
            'content' => ['required', 'string'],
        ];
    }
}
