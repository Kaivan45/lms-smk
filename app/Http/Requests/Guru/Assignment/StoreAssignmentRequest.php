<?php

namespace App\Http\Requests\Guru\Assignment;

use Illuminate\Foundation\Http\FormRequest;

class StoreAssignmentRequest extends FormRequest
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
            'deadline' => ['required', 'date', 'after:now'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul tugas wajib diisi.',
            'deadline.required' => 'Deadline wajib diisi.',
            'deadline.date' => 'Format deadline tidak valid.',
            'deadline.after' => 'Deadline harus di waktu yang akan datang.',
        ];
    }
}
