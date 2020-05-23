<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SystemRequest extends FormRequest
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
            'name' => 'required|max:60',
            'abrrev' => 'required|max:3',
            'description' => 'max:1000',
            'status' => 'required|max:1'
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('label.name'),
            'abrrev' => __('label.abrrev'),
            'description' => __('label.description'),
            'status' => __('label.status')
        ];
    }
}
