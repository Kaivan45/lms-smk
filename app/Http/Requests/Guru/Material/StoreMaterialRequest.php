<?php

namespace App\Http\Requests\Guru\Material;

use Illuminate\Foundation\Http\FormRequest;

class StoreMaterialRequest extends FormRequest
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
            'file' => [
                'required',
                'file',
                'mimes:pdf,doc,docx,ppt,pptx',
                'mimetypes:application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,application/zip,application/x-zip-compressed',
                'max:'.config('lms.max_upload_size_kb'),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul materi wajib diisi.',
            'file.required' => 'File materi wajib diupload.',
            'file.mimes' => 'File harus berformat PDF, DOC, DOCX, PPT, atau PPTX.',
            'file.max' => 'Ukuran file maksimal '.round(config('lms.max_upload_size_kb') / 1024).' MB.',
        ];
    }
}
