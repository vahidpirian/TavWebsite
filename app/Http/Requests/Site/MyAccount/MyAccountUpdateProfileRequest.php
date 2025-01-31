<?php

namespace App\Http\Requests\Site\MyAccount;

use Illuminate\Foundation\Http\FormRequest;

class MyAccountUpdateProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'mobile' => 'required|string|unique:users,mobile,' . auth()->id(),
            'national_code' => 'nullable|string|size:10|unique:users,national_code,' . auth()->id(),
            'password' => 'nullable|min:8|confirmed',
        ];
    }

    public function messages()
    {
        return [
            'first_name.required' => 'نام الزامی است',
            'last_name.required' => 'نام خانوادگی الزامی است',
            'mobile.required' => 'شماره موبایل الزامی است',
            'mobile.unique' => 'این شماره موبایل قبلا ثبت شده است',
            'national_code.required' => 'کد ملی الزامی است',
            'national_code.size' => 'کد ملی باید 10 رقم باشد',
            'national_code.unique' => 'این کد ملی قبلا ثبت شده است',
            'password.min' => 'رمز عبور باید حداقل 8 کاراکتر باشد',
            'password.confirmed' => 'رمز عبور و تکرار آن مطابقت ندارند',
        ];
    }
}
