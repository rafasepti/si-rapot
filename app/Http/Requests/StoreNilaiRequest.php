<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreNilaiRequest extends FormRequest
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
        if(session('walikelas')=="Ya"){
            return [
                'nilai_rl.*' => 'required|numeric|between:0,100',
                'nilai_tp.*' => 'required|numeric|between:0,100',
                'nilai_as.*' => 'required|numeric|between:0,100',
                'id_siswa' => 'required',
                'id_kelas' => 'required',
                'semester' => 'required',
                // Validasi untuk memastikan bahwa tidak ada entri dengan id_user, id_kelas, dan semester yang sama
                'semester' => [
                    Rule::unique('nilai')->where(function ($query) {
                        return $query->where('id_siswa', $this->id_siswa)
                                    ->where('id_kelas', $this->id_kelas)
                                    ->where('semester', $this->semester);
                    }),
                ],
            ];
        }else{
            return [
                'nilai_rl.*' => 'required|numeric|between:0,100',
                'nilai_tp.*' => 'required|numeric|between:0,100',
                'nilai_as.*' => 'required|numeric|between:0,100',
                'id_siswa' => 'required',
                'id_kelas' => 'required',
                'semester' => 'required',
            ];
        }
    }

    public function messages()
    {
        return [
            'semester.unique' => 'Data sudah ada untuk user ini, kelas ini, dan semester ini.',
        ];
    }
}
