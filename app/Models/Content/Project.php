<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'address',
        'company_mobile',
        'customer_mobile',
        'start_date',
        'end_date',
        'status_project',
        'status'
    ];

    protected function  statusProjectPersian(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status_project == 'process' ? 'درحال انجام' : 'تکمیل شده'
        );
    }

    protected function  statusPersian(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->status == 1 ? 'فعال' : 'غیرفعال'
        );
    }
}
