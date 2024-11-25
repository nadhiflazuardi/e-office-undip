<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Route;

class LuaranTugasRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $baseFileRule = ['file', 'mimes:pdf,doc,docx'];
        if (Route::currentRouteName() === 'tugas.store') {
            $baseFileRule[] = 'required';
        }
        return [
            'judul' => ['required', 'string'],
            'uraian' => ['required', 'string'],
            'keterangan' => ['required', 'string'],
            'file' => $baseFileRule,
        ];
    }
}
