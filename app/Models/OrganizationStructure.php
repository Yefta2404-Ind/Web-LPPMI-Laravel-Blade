<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationStructure extends Model
{
    use HasFactory;
 
    protected $fillable = [
        'name',
        'position',
        'photo',
        'order',
        'status',
        'user_id',
        'is_active', // TAMBAHKAN INI
        'created_by' // Juga tambahkan ini jika ada
    ];

    protected $casts = [
        'is_active' => 'boolean', // INI PENTING untuk boolean
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function members()
    {
        return $this->hasMany(OrganizationMember::class, 'organization_structure_id');
    }
}