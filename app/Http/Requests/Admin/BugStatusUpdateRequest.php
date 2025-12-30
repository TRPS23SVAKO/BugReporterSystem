<?php

namespace App\Http\Requests\Admin;

use App\Models\BugStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BugStatusUpdateRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        /** @var BugStatus $bugStatus */
        $bugStatus = $this->route('bugStatus');

        return [
            'key'        => ['required','string','max:20', Rule::unique('bug_statuses','key')->ignore($bugStatus->id)],
            'label'      => ['required','string','max:50'],
            'sort_order' => ['nullable','integer','min:0','max:65535'],
            'color'      => ['nullable','regex:/^[0-9A-Fa-f]{6}$/'],
            'is_active'  => ['nullable','boolean'],
        ];
    }
}
