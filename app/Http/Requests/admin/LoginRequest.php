<?php

namespace App\Http\Requests\admin;

use Illuminate\Contracts\Validation\Validator;
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
            'account'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha'
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
       return [
           'account.required'=>'请填写账号',
           'password.required'=>'请填写密码',
           'captcha.required'=>'请填写验证码',
           'captcha.captcha'=>'验证码不正确'
       ];
    }

    /**
     * @param Validator $validator
     * 接口返回错误信息格式
     */
    public function failedValidation(Validator $validator)
    {
        exit(json_encode([
            'msg'=>'004',
            'message'=>'错误信息',
            'errors'=>$validator->getMessageBag()->toArray()
        ]));
    }
}
