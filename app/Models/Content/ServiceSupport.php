<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSupport extends Model
{
    use HasFactory;

    protected $fillable = [
        'small_title',
        'title',
        'description',
        'button_text',
        'url_type',
        'url',
        'image',
        'status',
        'order'
    ];

    protected $casts = [
        'status' => 'boolean',
        'order' => 'integer'
    ];
} 