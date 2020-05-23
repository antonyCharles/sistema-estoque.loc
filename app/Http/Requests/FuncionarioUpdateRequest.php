<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FuncionarioUpdateRequest extends FormRequest
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
            'name' => 'required|max:80',
            'fun_endereco' => 'required|max:80',
            'fun_numero' => 'required|max:20',
            'fun_bairro' => 'required|max:80',
            'fun_cidade' => 'required|max:80',
            'fun_uf' => 'required|max:2',
            'fun_cnpjcpf' => 'required|max:14',
            'fun_rgie' => 'required|max:12',
            'fun_sexo' => 'required|max:1',
            'fun_nascimento' => 'required|date',
            'fun_telefone' => 'max:10',
            'fun_celular' => 'max:10',
            'email' => 'required|email|max:80',
            'fun_salario' => 'required',
            'profile_id' => 'required|max:1',
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('label.Nome'),
            'fun_endereco' => __('label.Endereco'),
            'fun_numero' => __('label.Numero'),
            'fun_complemento' => __('label.Complemento'),
            'fun_bairro' => __('label.Bairro'),
            'fun_cidade' => __('label.Cidade'),
            'fun_uf' => __('label.Uf'),
            'fun_cnpjcpf' => __('label.CnpjCpf'),
            'fun_rgie' => __('label.Rgie'),
            'fun_sexo' => __('label.Sexo'),
            'fun_nascimento' => __('label.DtNascimento'),
            'fun_telefone' => __('label.Telefone'),
            'fun_celular' => __('label.Celular'),
            'email' => __('label.Email'),
            'fun_salario' => __('label.Salario'),
            'profile_id' => __('label.Profile'),
        ];
    }
}
