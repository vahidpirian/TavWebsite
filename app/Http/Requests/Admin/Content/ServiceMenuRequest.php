<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class ServiceMenuRequest extends FormRequest
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
            'sub_top' => 'required|max:20|min:2',
            'sub_bottom' => 'required|max:20|min:2',
            'url' => 'nullable|max:1000',
            'status' => 'required|numeric|in:0,1',
            'parent_id' => 'nullable|exists:menus,id',
        ];
    }
}
