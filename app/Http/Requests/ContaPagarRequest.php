<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContaPagarRequest extends FormRequest
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
            'cp_valorconta' => 'required',
            'cp_datavencimento' => 'required|date',
            'nf_codigo' => 'required|numeric',
            'cp_observacoes' => 'max:80'
        ];
    }

    public function attributes()
    {
        return [
            'cp_valorconta' => __('label.ValorConta'),
            'cp_datavencimento' => __('label.DataVencimento'),
            'cp_datapagamento' => __('label.DataPagamento'),
            'nf_codigo' => __('label.NfCodigo'),
            'cp_observacoes' => __('label.Observacoes')
        ];
    }
}
