<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{

    protected $fillable = ['title', 'image', 'summary', 'description', 'status'];

    public function getIsActiveAttribute()
    {
        return $this->status === 1 ? 'فعال' : 'غیرفعال';
    }
} 