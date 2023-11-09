<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DataAnggotaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nik' => '|numeric|digits:16|unique:data_anggotas,nik',
            'nama' => '|string|max:255',
            'email' => '|email|unique:data_anggotas,email',
            'no_hp' => '|numeric|digits_between:12,13|unique:data_anggotas,no_hp',
            'tempat_lahir' => '|string|max:255',
            'tanggal_lahir' => '|date',
            'alamat' => '|string|max:255',
            'jenis_kelamin' => '|string',
            'rhesus' => '',
            'bersedia' => '',
            'status' => '',
            'keanggotaan' => '',
            'pendidikan' => '',
            'pekerjaan' => '',
            'domisili' => '',
            'nama_ayah' => '|string|max:255',
            'nama_ibu' => '|string|max:255',
            'keterangan_tinggal' => '',
            'wilayah' => '',
        ];
    }
}
