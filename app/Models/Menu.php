<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'url',
        'page_id',
        'parent_id',
        'order',
        'is_active',
    ];

    /**
     * Semua sub-menu (child) dari menu ini.
     * Catatan: tidak difilter is_active agar saat hapus parent,
     * seluruh child (aktif maupun nonaktif) ikut terhapus.
     */
public function children()
{
    return $this->hasMany(Menu::class, 'parent_id')->with('children');
}

    public function childrenAll()
{
    return $this->children()->with('childrenAll');
}
    
    public function activeChildren()
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

public function childrenRecursive()
{
    return $this->hasMany(Menu::class, 'parent_id')
        ->with('childrenRecursive')
        ->orderBy('order');
}

public function deleteWithChildren()
{
    foreach ($this->children as $child) {
        $child->deleteWithChildren();
    }

    $this->delete();
}
}