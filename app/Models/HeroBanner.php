<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroBanner extends Model
{
    protected $fillable = [
        'title',
        'image',
        'link',
        'order',
        'is_active',
        'status',
        'created_by',
        'approved_by',
        'approved_at',
    ];

public function scopeActive($q)
{
    return $q->where('status','approved')
             ->where('is_active',1)
             ->orderBy('order');
}

}
