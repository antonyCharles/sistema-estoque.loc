<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendaUpdateRequest extends FormRequest
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
            'fun_codigo' => 'required|int',
            'tpg_codigo' => 'required|int',
            'ven_datavenda' => 'required|date',
            'ven_status' => 'required:max:1'
        ];
    }
}
