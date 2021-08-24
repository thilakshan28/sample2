<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'name' =>'required',
            'email' => 'required|email|unique:users',
            'department'=>'required',
            'role_id1' => 'required_if:department,Education',
            'role_id2' => 'required_if:department,Blog',
            'password' => 'required | confirmed | string | min:8',

        ];
    }
}
