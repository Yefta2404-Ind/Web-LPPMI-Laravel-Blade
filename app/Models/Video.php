<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $fillable = [
    'user_id',
    'title',
    'description',
    'url',
    'video_path',
    'thumbnail',
    'duration',
    'views',
    'status',
    'is_published',
    'is_featured',
    'approved_by',
    'approved_at'
];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured'  => 'boolean',
    ];


    /* ===== RELATION ===== */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /* ===== SCOPES ===== */
    public function scopeApproved($query)
    {
        return $query
            ->where('status', 'approved')
            ->where('is_published', 1);
    }

    public function scopePublished($q)
    {
        return $q->where('is_published', 1);
    }
}
