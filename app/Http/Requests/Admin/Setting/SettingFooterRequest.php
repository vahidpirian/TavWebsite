<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class SettingFooterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title_enamed' => 'nullable|string|max:255',
            'text_copyright' => 'nullable|string|max:255',
            'enamads.*.title' => 'nullable|string|max:255',
            'enamads.*.link' => 'nullable|url|max:255',
            'enamads.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ];
    }
} 