<?php

namespace App\Users;

use Sentinel;
use App\Users\EloquentPermission;
use App\Users\PermissionRepository;


/**
* 
*/
class Sentinel_ex extends Sentinel
{

    protected $permissions;

    public function __construct(PermissionRepositoryInterface $permissions) {

        $this->permissions = $permissions;
    }


    public function setPermissionRepository(PermissionRepositoryInterface $permissions)
    {
        $this->permissions = $permissions;
    }

    public function getPermissionRepository()
    {
        return $this->permissions;
    }

    public function getPermissionArray()
    {
        $permissions  = $this->getPermissionRepository()->findAll();
        foreach ($permissions as $key => $permission) {
            $PermissionsArray[$permission->slug] = $permission->name;
        }
        return $PermissionsArray;
    }



}