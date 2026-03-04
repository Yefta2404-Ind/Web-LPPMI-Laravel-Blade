<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
    'title',
    'page_id',
    'parent_id',
    'order',
    'is_active',
];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')
                    ->where('is_active', true)
                    ->orderBy('order');
    }

    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function page()
{
    return $this->belongsTo(\App\Models\Page::class);
}
}