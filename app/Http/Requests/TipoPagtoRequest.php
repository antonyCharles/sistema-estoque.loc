<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoPagtoRequest extends FormRequest
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
            'tpg_descricao' => 'required|max:80',
            'tpg_qtde' => 'required|numeric',
            'tpg_ativo' => 'required|max:1'
        ];
    }

    public function attributes()
    {
        return [
            'tpp_descricao' => __('label.Descricao'),
            'tpg_qtde' => __('label.Qtde'),
            'tpg_ativo' => __('label.Ativo'),
        ];
    }
}
