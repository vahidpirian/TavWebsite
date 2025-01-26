<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class VideoRequest extends FormRequest
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
            'title' => 'required|max:120|min:2',
            'type' => 'required|in:upload,link',
            'video' => 'nullable|mimes:mp4',
            'url_video' => 'nullable|string',
            'position' => 'nullable|string',
            'status' => 'required|numeric|in:0,1',
        ];
    }
}
