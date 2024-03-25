<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGuruRequest extends FormRequest
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
        $kodeGuru = $this->route('kode_guru');
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('guru')->where(function ($query) use ($kodeGuru) {
                    return $query->where('kode_guru', $kodeGuru);
                })->ignore($kodeGuru),
            ],
        ];
    }
}
