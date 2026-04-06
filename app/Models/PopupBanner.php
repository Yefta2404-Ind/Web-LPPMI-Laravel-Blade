<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PopupBanner extends Model
{
    protected $fillable = ['image_path', 'is_active'];

    // Ambil banner yang aktif
    public static function getActive()
    {
        return self::where('is_active', true)->latest()->first();
    }
}
