<?php

namespace App\Users;

use Illuminate\Database\Eloquent\Model;

class EloquentPermission extends Model
{

    protected $table = 'permissions';

	protected $fillable = [
		'name',
		'slug',
	];

	

	protected $permission;
	protected static $usersModel = 'Cartalyst\Sentinel\Users\EloquentUser';
	protected static $rolesModel = 'Cartalyst\Sentinel\Roles\EloquentRole';

	 /**
     * The roles relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(static::$rolesModel, 'permission_roles', 'permission_id' ,'role_id')->withTimestamps();
    }


     /**
     * The Users relationship.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(static::$usersModel, 'permission_users', 'permission_id', 'user_id')->withTimestamps();
    }



	public function getPermissionSlug()
	{
		return $this->slug;
	}

	public function getUsers()
	{
		return $this->users;
	}

	public function getRoles()
	{
		return $this->roles;
	}

}
