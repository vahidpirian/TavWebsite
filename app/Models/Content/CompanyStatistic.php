<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyStatistic extends Model
{
    protected $fillable = ['title', 'number'];
}
