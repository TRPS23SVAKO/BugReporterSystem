<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BugStatusStoreRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'key'        => ['required','string','max:20', Rule::unique('bug_statuses','key')],
            'label'      => ['required','string','max:50'],
            'sort_order' => ['nullable','integer','min:0','max:65535'],
            'color'      => ['nullable','regex:/^[0-9A-Fa-f]{6}$/'],
            'is_active'  => ['nullable','boolean'],
        ];
    }
}
