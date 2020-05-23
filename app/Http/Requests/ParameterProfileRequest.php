<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParameterProfileRequest extends FormRequest
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
            'value' => 'required',
            'parameter_id' => 'required',
            'profile_id' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'value' => __('label.value'),
            'parameter_id' => __('label.parameter'),
            'profile_id' => __('label.profile')
        ];
    }
}
