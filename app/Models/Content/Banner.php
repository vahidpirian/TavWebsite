<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use HasFactory, SoftDeletes;


    protected $casts = ['image' => 'array'];



    protected $fillable = [
        'title',
        'image',
        'url',
        'position',
        'status'
    ];


    public static $positions = [
        0   =>  'بالای بخش خدمات تخصصی (صفحه اصلی)',
        1   =>  'صحفه تماس باما',
        2   =>  'صحفه پیج ها',
        3   =>  'بالا (صفحه خدمات ها)',
        4   =>  'بالا (صفحه پروژه ها)',
        5   =>  'بالا (صفحه وبلاگ ها)',
        6   =>  'پایین (صفحه خدمات ها)',
        7   =>  'پایین (صفحه پروژه ها)',
        8   =>  'پایین (صفحه وبلاگ ها)',
        9   =>  'بالا (صفحه جزئیات خدمات)',
        10   =>  'بالا (صفحه جزئیات پروژه)',
        11   =>  'بالا (صفحه جزئیات وبلاگ)',
        12   =>  'پایین (صفحه جزئیات خدمات)',
        13   =>  'پایین (صفحه جزئیات پروژه)',
        14   =>  'پایین (صفحه جزئیات وبلاگ)',
        15   =>  'صحفه سوالات متداول',
    ];
}
