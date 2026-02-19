<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpmiCategory extends Model
{
    protected $table = 'spmi_categories';

    protected $fillable = [
        'name',
        'slug'
    ];

    public function documents()
    {
        return $this->hasMany(SpmiDocument::class, 'category_id');
    }
}
