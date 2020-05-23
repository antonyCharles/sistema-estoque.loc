<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleActionRequest extends FormRequest
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
            'name' => 'required|max:40',
            'status' => 'required|max:1'
        ];
    }

    public function attributes()
    {
        return [
            'name' => __('label.name'),
            'status' => __('label.status')
        ];
    }
}
