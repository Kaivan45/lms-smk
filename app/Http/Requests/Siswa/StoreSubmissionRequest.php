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
            'file' => [
                'required',
                'file',
                'mimes:pdf,doc,docx,ppt,pptx,zip,jpg,jpeg,png',
                'mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/zip,application/x-zip-compressed,image/jpeg,image/png',
                'max:'.config('lms.max_upload_size_kb'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'File jawaban wajib diupload.',
            'file.mimes' => 'File harus berformat PDF, DOC, DOCX, PPT, PPTX, ZIP, JPG, atau PNG.',
            'file.max' => 'Ukuran file maksimal '.round(config('lms.max_upload_size_kb') / 1024).' MB.',
        ];
    }
}
