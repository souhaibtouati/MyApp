<?php

namespace App\Users;

use Cartalyst\Sentinel\Roles\EloquentRole;

class Role extends EloquentRole
{
	
    /**
     * The Eloquent permissions model name.
     *
     * @var string
     */
    protected static $permissionsModel = 'App\Users\EloquentPermission';

    /**
     * The Permissions relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function Permissions()
    {
        return $this->belongsToMany(static::$permissionsModel, 'permission_roles', 'permission_id', 'role_id')->withTimestamps();
    }


    public function getPermissions()
    {
    	return $this->permissions;
    }

	
}