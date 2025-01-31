<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
   protected $fillable = [
       'title',
       'type',
       'video',
       'url_video',
       'position',
       'status'
   ];

    public function isUploadType()
    {
        return $this->type === 'upload';
    }

    public function getPositionPersianAttribute()
    {
        return match ($this->position){
            "main_page" => 'صحفه اصلی',
        };
    }

    protected function  statusPersian(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status == 1 ? 'فعال' : 'غیرفعال'
        );
    }
}
