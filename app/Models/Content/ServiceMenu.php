<?php

namespace App\Models\Content;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceMenu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sub_top',
        'sub_bottom',
        'type',
        'url_type',
        'url',
        'icon',
        'parent_id',
        'sort_order',
        'status'
    ];

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id')->with('parent');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id')->with('children');
    }
}
