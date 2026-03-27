<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
protected $fillable = [
    'title',
    'description',
    'survey_url',
    'qr_code',
    'status',
    'created_by',
    'start_date',
    'end_date',
];

        public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

        public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function user()
{
    return $this->belongsTo(\App\Models\User::class, 'created_by');
}
}

