<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBugRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'assigned_to' => ['sometimes', 'nullable', 'integer', 'exists:users,id'],

            'title' => ['sometimes', 'required', 'string', 'max:255'],
            'description' => ['sometimes', 'required', 'string'],

            'status_id' => ['sometimes', 'required', 'integer', 'exists:bug_statuses,id'],
            'severity_id' => [
                'sometimes', 'required', 'integer',
                Rule::exists('bug_levels', 'id')->where(fn ($q) => $q->where('type', 'severity'))
            ],
            'priority_id' => [
                'sometimes', 'required', 'integer',
                Rule::exists('bug_levels', 'id')->where(fn ($q) => $q->where('type', 'priority'))
            ],

            'steps_to_reproduce' => ['sometimes', 'nullable', 'string'],
            'expected_result' => ['sometimes', 'nullable', 'string'],
            'actual_result' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
