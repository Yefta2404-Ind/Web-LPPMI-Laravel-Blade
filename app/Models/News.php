<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'status',
        'user_id',
        'image',
        'is_featured',
        'category_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function category()
{
    return $this->belongsTo(Category::class);
}

public function scopeLatestMonth($query)
{
    return $query->where('created_at', '>=', now()->subMonth());
}

}
