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
    'order',
    'parent_id',
    'level'
];

    public function structure()
    {
        return $this->belongsTo(OrganizationStructure::class, 'organization_structure_id');
    }

    public function parent()
{
    return $this->belongsTo(OrganizationMember::class, 'parent_id');
}

public function children()
{
    return $this->hasMany(OrganizationMember::class, 'parent_id')
                ->orderBy('order');
}
}
