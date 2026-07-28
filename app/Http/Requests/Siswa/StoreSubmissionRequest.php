<?php

namespace App\Http\Requests\Siswa;

use Illuminate\Foundation\Http\FormRequest;

class StoreSubmissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'file' => ['required', 'file', 'mimes:pdf,doc,docx,ppt,pptx,zip,jpg,jpeg,png', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'File jawaban wajib diupload.',
            'file.mimes' => 'File harus berformat PDF, DOC, DOCX, PPT, PPTX, ZIP, JPG, atau PNG.',
            'file.max' => 'Ukuran file maksimal 10 MB.',
        ];
    }
}
