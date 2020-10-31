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
            'name'  =>  ['required'],
            'password'  =>  ['required'],
//            'captcha' => 'required|captcha',
            'captcha' => 'required|captcha_api:'. request('key') . ',default'
        ];
    }
    public function messages()
    {
        return [
            'name.*' => '请输入用户名',
            'password.*'  =>    '请输入密码',
            'captcha.required'   =>  '请输入验证码',
            'captcha.captcha_api'   =>  '验证码不正确'
        ];
    }
}
