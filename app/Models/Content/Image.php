<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    protected $fillable = ['image', 'position'];

    public function getPositionPersianAttribute()
    {
        return match ($this->position){
            "1" => 'صحفه اصلی',
            "2" => 'بخش چرا تاو 360',
            "3" => 'پیش نمایش ویدیو صحفه اصلی',
        };
    }
}
