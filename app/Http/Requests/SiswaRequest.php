<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255'
            ],
            'nisn' => [
                'required',
                'string',
                'unique:siswas,nisn',
            ],
            'kelas_id' => [
               'required',
               'integer',
            ],
            'jenis_kelamin' => [
                'required',
                'in:Laki-laki,Perempuan'
            ]
        ];
    }
}
