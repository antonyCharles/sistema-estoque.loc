<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'role_id' => 'required',
            'item_status' => 'required',
            'name' => 'required',
            'role' => 'required',
            'role_father_id' => 'required',
            'role_action_id' => 'required',
            'status' => 'required'
        ];
    }
}
