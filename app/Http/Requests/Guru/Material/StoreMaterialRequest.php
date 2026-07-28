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
            'file' => ['required', 'file', 'mimes:pdf,doc,docx,ppt,pptx', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul materi wajib diisi.',
            'file.required' => 'File materi wajib diupload.',
            'file.mimes' => 'File harus berformat PDF, DOC, DOCX, PPT, atau PPTX.',
            'file.max' => 'Ukuran file maksimal 10 MB.',
        ];
    }
}
