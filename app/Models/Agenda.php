<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
    'title',
    'description',
    'date',
    'time',
    'location',
    'status',
    'image',
    'user_id',
];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ✅ INI YANG KURANG
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }


public function scopeVisible($query)
{
    return $query->where('status', 'approved')
                 ->where('date', '>=', now()->subDays(3)->toDateString());
}
}
