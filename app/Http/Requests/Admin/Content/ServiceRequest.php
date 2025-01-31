<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if ($this->isMethod('post')){
            return [
                'title' => 'required|max:120|min:2',
                'summary' => 'required|max:300|min:2',
                'description' => 'required|min:2',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
            ];
        }else{
            return [
                'title' => 'required|max:120|min:2',
                'summary' => 'required|max:300|min:2',
                'description' => 'required|min:2',
                'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
            ];
        }

    }
}
