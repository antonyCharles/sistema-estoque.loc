<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContaReceberRequest extends FormRequest
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
            'cr_valorconta' => 'required',
            'cr_datavencimento' => 'required|date',
            'nf_codigo' => 'required|numeric',
            'cr_observacoes' => 'max:80'
        ];
    }

    public function attributes()
    {
        return [
            'cr_valorconta' => __('label.ValorConta'),
            'cr_datavencimento' => __('label.DataVencimento'),
            'cr_datarecebimento' => __('label.DataPagamento'),
            'nf_codigo' => __('label.NfCodigo'),
            'cr_observacoes' => __('label.Observacoes')
        ];
    }
}
