<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
                'title' => 'required|max:120|min:2',
                'summary' => 'required|max:300|min:5',
                'category_id' => 'required|min:1|max:100000000|exists:post_categories,id',
                'image' => 'required|image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'nullable',
                'body' => 'required|min:5',
                'published_at' => 'required|numeric',

            ];
        }
        else{
            return [
                'title' => 'required|max:120|min:2',
                'summary' => 'required',
                'category_id' => 'required|exists:post_categories,id',
                'image' => 'image|mimes:png,jpg,jpeg,gif',
                'status' => 'required|numeric|in:0,1',
                'tags' => 'nullable',
                'body' => 'required',
                'published_at' => 'required|numeric',
            ];
        }
    }
}
