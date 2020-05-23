<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParameterRequest extends FormRequest
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
            'label' => 'required|max:80',
            'values_select' => 'max:1000',
            'group_parameter_id' => 'required|numeric',
            'type_parameter' => 'required|max:1',
            'status' => 'required|max:1'
        ];
    }

    public function attributes()
    {
        return [
            'label' => __('label.label'),
            'values_select' => __('label.valuesSelect'),
            'group_parameter_id' => __('label.groupParameter'),
            'type_parameter' => __('label.typeParameter'),
            'status' => __('label.status')
        ];
    }
}
