<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExternalQuality extends Model
{
    protected $fillable = [
    'title',
    'description',
    'section',
    'file_path',
    'external_url',
    'status',
    'user_id',
    'rejection_note'
];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
