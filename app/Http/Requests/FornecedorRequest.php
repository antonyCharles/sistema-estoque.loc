<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorRequest extends FormRequest
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
            'for_nome' => 'required|max:80',
            'for_endereco' => 'required|max:80',
            'for_numero' => 'required|max:20',
            'for_bairro' => 'required|max:80',
            'for_cidade' => 'required|max:80',
            'for_uf' => 'required|max:2',
            'for_cnpjcpf' => 'required|max:14',
            'for_telefone' => 'required|max:10',
            'for_celular' => 'max:10',
            'for_fax' => 'max:10',
            'for_email' => 'required|max:80'
        ];
    }
    
    public function attributes()
    {
        return [
            'for_nome' => __('label.Nome'),
            'for_endereco' => __('label.Endereco'),
            'for_numero' => __('label.Numero'),
            'for_bairro' => __('label.Bairro'),
            'for_cidade' => __('label.Cidade'),
            'for_uf' => __('label.Uf'),
            'for_cnpjcpf' => __('label.CnpjCpf'),
            'for_rgie' => __('label.Rgie'),
            'for_telefone' => __('label.Telefone'),
            'for_fax' => __('label.Fax'),
            'for_celular' => __('label.Celular'),
            'for_email' => __('label.Email')
        ];
    }
}
