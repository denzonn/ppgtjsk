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
            'nik' => 'required|numeric|digits:16|unique:data_anggotas,nik',
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:data_anggotas,email',
            'no_hp' => 'required|numeric|digits_between:12,13|unique:data_anggotas,no_hp',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'rhesus' => 'required',
            'bersedia' => 'required',
            'status' => 'required',
            'keanggotaan' => 'required',
            'pendidikan' => 'required',
            'pekerjaan' => 'required',
            'domisili' => 'required',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'keterangan_tinggal' => 'required',
            'wilayah' => 'required',
        ];
    }
}
