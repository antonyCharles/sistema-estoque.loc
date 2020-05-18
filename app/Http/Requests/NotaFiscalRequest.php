<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaFiscalRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nf_valornf' => 'required',
            'nf_taxaimpostonf' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'nf_valornf' => __('label.ValorNf'),
            'nf_taxaimpostonf' => __('label.TaxaImpostoNf'),
        ];
    }
}
