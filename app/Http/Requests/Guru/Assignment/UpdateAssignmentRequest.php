<?php

namespace App\Http\Requests\Guru\Assignment;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline' => ['required', 'date'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul tugas wajib diisi.',
            'deadline.required' => 'Deadline wajib diisi.',
            'deadline.date' => 'Format deadline tidak valid.',
        ];
    }
}
