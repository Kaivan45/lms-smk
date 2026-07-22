<?php

namespace App\Http\Requests\Admin\AcademicYear;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAcademicYearRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('academicYear')->id;

        return [
            'name' => [
                'required',
                'string',
                'max:20',
                Rule::unique('academic_years', 'name')
                    ->where('semester', $this->input('semester'))
                    ->ignore($id),
            ],
            'semester' => ['required', Rule::in(['Ganjil', 'Genap'])],
            'is_active' => ['nullable', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama tahun ajaran wajib diisi.',
            'name.unique' => 'Tahun ajaran dengan nama dan semester yang sama sudah ada.',
            'semester.required' => 'Semester wajib dipilih.',
            'semester.in' => 'Semester harus Ganjil atau Genap.',
        ];
    }
}
