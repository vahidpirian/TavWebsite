<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        if($this->isMethod('post')){

            return [
                'first_name' => 'required|max:120|min:1',
                'last_name' => 'required|max:120|min:1',
                'mobile' => ['required','digits:11', 'unique:users'],
                'email' => ['nullable','string','email','unique:users'],
                'password' => ['required','unique:users', Password::min(8), 'confirmed'],
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'activation' => 'required|numeric|in:0,1',
            ];
        }
        else{
            return [
                'first_name' => 'required|max:120|min:1',
                'last_name' => 'required|max:120|min:1',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            ];
        }
    }
}
