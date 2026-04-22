<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

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

    protected $appends = ['clean_excerpt', 'reading_time'];

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

    public function images()
    {
        return $this->hasMany(NewsImage::class);
    }

    // Accessor untuk excerpt bersih (tanpa HTML)
    public function getCleanExcerptAttribute($length = 120)
    {
        $content = html_entity_decode($this->content);
        $content = strip_tags($content);
        $content = preg_replace('/\s+/', ' ', $content);
        $content = trim($content);
        
        return Str::limit($content, $length);
    }

    // Accessor untuk waktu baca
    public function getReadingTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        return ceil($wordCount / 200) . ' menit';
    }
}