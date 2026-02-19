<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'organization_structure_id',
        'name',
        'position',
        'photo',
        'order'
    ];

    public function structure()
    {
        return $this->belongsTo(OrganizationStructure::class, 'organization_structure_id');
    }
}
