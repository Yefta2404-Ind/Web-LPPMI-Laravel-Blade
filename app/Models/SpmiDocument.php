<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpmiDocument extends Model
{
    protected $fillable = [
    'title',
    'category_id',
    'description',
    'file_path',
    'status',
    'created_by'
];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function category()
{
    return $this->belongsTo(SpmiCategory::class, 'category_id');
}




}

