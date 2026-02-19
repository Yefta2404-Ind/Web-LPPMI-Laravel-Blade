<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternalQuality extends Model
{
    protected $fillable = [
        'category_id',
        'year',
        'file_path',
        'external_url',
        'status',
        'user_id'
    ];

    public function category()
{
    return $this->belongsTo(InternalCategory::class, 'category_id');
}


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

