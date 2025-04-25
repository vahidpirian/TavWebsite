<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingFooter extends Model
{
    use HasFactory;

    protected $table = 'setting_footer';

    protected $fillable = [
        'title_enamad',
        'text_copyright',
        'enamads'
    ];

    protected $casts = [
        'enamads' => 'array'
    ];
}
