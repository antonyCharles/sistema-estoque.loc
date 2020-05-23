<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|min:10|max:80',
            'password' => 'required|string'
        ];
    }

    public function attributes()
    {
        return [
            'email' => __('label.email'),
            'password' => __('label.password')
        ];
    }
}
