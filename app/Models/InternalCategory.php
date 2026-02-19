<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class InternalCategory extends Model
{
    protected $fillable = ['name'];
    protected static function booted()
{
    static::creating(function ($category) {
        $category->slug = Str::slug($category->name);
    });
}

    public function qualities()
{
    return $this->hasMany(InternalQuality::class, 'category_id');
}

}

