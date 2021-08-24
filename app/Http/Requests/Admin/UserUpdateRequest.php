<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
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
        $user = $this->user;
        if(Auth::user()->role->name == 'Admin'){
        return [
            'name' =>'required',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user)],
            'department'=>'required',
            'role_id1' => 'required_if:department,Education',
            'role_id2' => 'required_if:department,Blog',
            'password' => 'nullable | confirmed | string | min:8',

        ];}
        else{
            return [
                'name' =>'required',
                'password' => 'nullable| confirmed |string| min:8',
            ];}
    }
}

