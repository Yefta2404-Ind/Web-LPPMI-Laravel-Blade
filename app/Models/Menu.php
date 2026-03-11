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
        return $this->hasMany(Menu::class, 'parent_id')
                    ->orderBy('order');
    }

    /**
     * Sub-menu yang aktif saja — dipakai untuk render navigasi di frontend.
     */
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
}