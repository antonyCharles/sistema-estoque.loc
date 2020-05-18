<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
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
            'pro_descricao' => 'required|max:80',
            'tpp_codigo' => 'required|numeric',
            'pro_precocusto' => 'required',
            'pro_precovenda' => 'required', 
            'pro_estoque' => 'required|numeric|min:0',
            'pro_embalagem' => 'required|max:2',
            'pro_ipi' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'pro_descricao' => __('label.Descricao'),
            'tpp_codigo' => __('label.TipoProduto'),
            'pro_precocusto' => __('label.PrecoCusto'),
            'pro_precovenda' => __('label.PrecoVenda'), 
            'pro_estoque' => __('label.Estoque'), 
            'pro_embalagem' => __('label.Embalagem'), 
            'pro_ipi' => __('label.Ipi')
        ];
    }
}
