<?php

namespace App\Models\Default;

class Role extends Model
{
    const GUEST = 'guest';

    public $cascadeDeletes = ['rolePermissions'];

    protected $fillable = [
        'name',
    ];

    public function rolePermissions()
    {
        return $this->hasMany(RolePermission::class);
    }

    public function permissions()
    {
        return $this->hasManyThrough(
            Permission::class,
            RolePermission::class,
            'role_id',
            'id',
            'id',
            'permission_id',
        );
    }
}
