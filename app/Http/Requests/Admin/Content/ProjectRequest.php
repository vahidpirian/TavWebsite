<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
        return [
            'name' => 'required|max:120|min:2',
            'description' => 'required|min:5',
            'address' => 'required|min:1',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,gif',
            'company_mobile' => 'nullable|numeric',
            'customer_mobile' => 'nullable|numeric',
            'start_date' => 'nullable',
            'end_date' => 'nullable',
            'status_project' => 'required|in:process,completed',
            'status' => 'required|numeric|in:0,1',
        ];
    }
}
