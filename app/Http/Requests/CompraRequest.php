<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompraRequest extends FormRequest
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
            'for_codigo' => 'required|int',
            'tpg_codigo' => 'required|int',
            'com_datacompra' => 'required|date',
            'pro_codigo' => 'required',
            'com_quantidade' => 'required',
            'com_desconto' => 'required',
            'com_status' => 'required:max:1'
        ];
    }
}
