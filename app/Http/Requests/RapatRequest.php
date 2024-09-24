<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RapatRequest extends FormRequest
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
        $validationRules = [
            'judul' => 'required|string',
            'pemimpinRapat' => 'required|string',
            'perihal' => 'required|string',
            'waktuMulai' => 'required',
            'waktuSelesai' => 'required',
            'tempat' => 'required|string',
            'pesertaRapat' => 'required|array',
        ];
        // if request is from rapat.create, add 'tanggal' to the validation rules
        if (request()->has('tanggal')){
            $validationRules['tanggal'] = 'required';
        }

        return $validationRules;
    }
}
