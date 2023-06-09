<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class KsbRequest extends FormRequest
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
            'nama' => 'required',
            'jabatan' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120',
            'motto' => 'required',
            'instagram' => 'nullable',
            'facebook' => 'nullable',
            'whatsapp' => 'nullable',
        ];
    }
}
