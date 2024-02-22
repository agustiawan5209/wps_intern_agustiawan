<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLogHarianRequest extends FormRequest
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
            'id_pegawai' => 'required|integer',
            'tanggal' => 'required|date',
            'deskripsi' => 'required|string|max:255',
            'file' => 'nullable|file|max:255',
            'status' => 'required|in:Direktur,Manager,Staff',
        ];
    }
}
