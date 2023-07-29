<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreKurbanHewanRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            // 'kurban_id' => 'required|exists:kurbans,id', // exitst ini menunjukkan bahwa si ID tersebut apakah ada di table kurban, kolom ID
            'kurban_id' => [
                'required',
                Rule::exists('kurbans', 'id')->where('masjid_id', auth()->user()->masjid_id)
            ],
            'hewan' => 'required|in:kambing,sapi,domba,kerbau,onta',
            'iuran_perorang' => 'required|numeric',
            'kriteria' => 'nullable',
            'harga' => 'nullable|numeric',
            'biaya_operasional' => 'nullable|numeric',
        ];
    }

    // Selanjutnya kita membutuhkan fitur laravel yaitu Prepare for Validation
    // Kita dapat memanipulasi inputan sebelum di validasi di rules() diatas -> saya mau buang dulu "titiknya" agar bisa masuk kategori numeric
    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        if ($this->harga != null) {
            $this->merge([
                'harga' => str_replace('.', '', $this->harga),
            ]);
        }

        if ($this->biaya_operasional != null) {
            $this->merge([
                'biaya_operasional' => str_replace('.', '', $this->biaya_operasional),
            ]);
        }

        $this->merge([
            'iuran_perorang' => str_replace('.', '', $this->iuran_perorang),
            // 'harga' => str_replace('.', '', $this->harga),
            // 'biaya_operasional' => str_replace('.', '', $this->biaya_operasional),
        ]);
    }
}
