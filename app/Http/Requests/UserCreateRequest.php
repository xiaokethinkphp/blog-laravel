<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'max:12', 'confirmed'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' =>  '请输入用户名',
            'name.min' =>  '用户名不少于3个',
            'email.required' =>  '请输入邮箱',
            'email.unique' =>  '该邮箱已被使用',
            'password.required' =>  '请输入6-12位密码',
            'password.min' =>  '请输入6-12位密码',
            'password.max' =>  '请输入6-12位密码',
            'password.confirmed' =>  '两次密码不一致',

        ];
    }
}
