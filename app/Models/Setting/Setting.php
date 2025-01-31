<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'keywords',
        'main_page_subtitle',
        'main_page_service_summary',
        'main_page_title',
        'address',
        'mobile',
        'email',
        'socials',
        'logo',
        'icon'
    ];

    protected $casts = [
        'socials' => 'array',
    ];
}
