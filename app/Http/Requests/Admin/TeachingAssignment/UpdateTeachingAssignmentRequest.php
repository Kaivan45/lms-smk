<?php

namespace App\Http\Requests\Admin\TeachingAssignment;

use App\Models\TeachingAssignment;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTeachingAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'teacher_id' => ['required', 'exists:users,id'],
            'class_id' => ['required', 'exists:classes,id'],
            'subject_id' => ['required', 'exists:subjects,id'],
            'academic_year_id' => ['required', 'exists:academic_years,id'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            $currentId = $this->route('teachingAssignment')->id;

            $exists = TeachingAssignment::where('teacher_id', $this->input('teacher_id'))
                ->where('class_id', $this->input('class_id'))
                ->where('subject_id', $this->input('subject_id'))
                ->where('academic_year_id', $this->input('academic_year_id'))
                ->where('id', '!=', $currentId)
                ->exists();

            if ($exists) {
                $validator->errors()->add('subject_id', 'Kombinasi guru, kelas, mata pelajaran, dan tahun ajaran ini sudah ada.');
            }
        });
    }

    public function messages(): array
    {
        return [
            'teacher_id.required' => 'Guru wajib dipilih.',
            'teacher_id.exists' => 'Guru yang dipilih tidak valid.',
            'class_id.required' => 'Kelas wajib dipilih.',
            'class_id.exists' => 'Kelas yang dipilih tidak valid.',
            'subject_id.required' => 'Mata pelajaran wajib dipilih.',
            'subject_id.exists' => 'Mata pelajaran yang dipilih tidak valid.',
            'academic_year_id.required' => 'Tahun ajaran wajib dipilih.',
            'academic_year_id.exists' => 'Tahun ajaran yang dipilih tidak valid.',
        ];
    }
}
