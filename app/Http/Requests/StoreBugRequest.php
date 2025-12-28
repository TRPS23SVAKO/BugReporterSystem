<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBugRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'project_id' => ['required', 'integer', 'exists:projects,id'],
            'assigned_to' => ['nullable', 'integer', 'exists:users,id'],

            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],

            'status_id' => ['required', 'integer', 'exists:bug_statuses,id'],

            'severity_id' => [
                'required', 'integer',
                Rule::exists('bug_levels', 'id')->where(fn ($q) => $q->where('type', 'severity'))
            ],
            'priority_id' => [
                'required', 'integer',
                Rule::exists('bug_levels', 'id')->where(fn ($q) => $q->where('type', 'priority'))
            ],

            'steps_to_reproduce' => ['nullable', 'string'],
            'expected_result' => ['nullable', 'string'],
            'actual_result' => ['nullable', 'string'],
        ];
    }
}
