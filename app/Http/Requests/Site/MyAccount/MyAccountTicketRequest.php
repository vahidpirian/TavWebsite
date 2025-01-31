<?php

namespace App\Http\Requests\Site\MyAccount;

use Illuminate\Foundation\Http\FormRequest;

class MyAccountTicketRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'priority_id' => 'required|exists:ticket_priorities,id',
            'category_id' => 'required|exists:ticket_categories,id',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,gif,pdf,doc,docx,zip,rar|max:5120', // 5MB
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => 'موضوع تیکت الزامی است',
            'description.required' => 'متن تیکت الزامی است',
            'priority_id.required' => 'اولویت تیکت الزامی است',
            'category_id.required' => 'دسته‌بندی تیکت الزامی است',
            'file.mimes' => 'فرمت فایل مجاز نیست',
            'file.max' => 'حجم فایل نمی‌تواند بیشتر از 5 مگابایت باشد',
        ];
    }
}
