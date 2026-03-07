<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

protected $fillable = [
    'title',
    'slug',
    'content',
    'featured_image',
    'status',
];

public function scopePublished($query)
{
    return $query->where('status', 'published');
}
}
