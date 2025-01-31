<?php

namespace App\Http\Requests\Auth\User;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'mobile' => 'required|min:11|max:11|regex:/^09[0-9]{9}$/|unique:users,mobile',
            'password' => 'required|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'mobile.required' => 'لطفا شماره موبایل خود را وارد کنید',
            'mobile.min' => 'شماره موبایل باید 11 رقم باشد',
            'mobile.max' => 'شماره موبایل باید 11 رقم باشد',
            'mobile.regex' => 'لطفا شماره موبایل معتبر وارد کنید',
            'mobile.unique' => 'این شماره موبایل قبلا ثبت شده است',
            'password.required' => 'لطفا رمز عبور را وارد کنید',
            'password.min' => 'رمز عبور باید حداقل 8 کاراکتر باشد',
            'password.confirmed' => 'رمز عبور و تکرار آن یکسان نیستند',
        ];
    }
} 