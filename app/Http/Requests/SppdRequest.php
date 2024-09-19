<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SppdRequest extends FormRequest
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
        return [
            'pemberi_perintah_id' => ['required', 'exists:users,id'],
            'jabatan_pemberi_perintah_id' => ['required', 'exists:jabatan,id'],
            'pelaksana_id' => ['required', 'exists:users,id'],
            'jabatan_pelaksana_id' => ['required', 'exists:jabatan,id'],
            'nomor_surat' => ['required', 'unique:perjalanan_dinas,nomor_surat'],
            'tanggal_surat' => ['required', 'date'],
            'tujuan_perjalanan' => ['required'],
            'tanggal_mulai' => ['required', 'date'],
            'tanggal_selesai' => ['required', 'date'],
            'anggaran' => ['required', 'numeric'],
            'keterangan' => ['required'],
        ];
    }
}
