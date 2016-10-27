<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Sentinel;
use Activation;
use Session;
use SentinelEx;
use Illuminate\Support\Facades\Input;
use App\Users\PermissionRepositoryInterface;


class PermissionController extends Controller
{


    public function __construct()
    {
       $this->middleware('Admin');
    }
   
    public function PermissionIndex()
    {
       
        $roles = Sentinel::getRoleRepository()->all();
        $permissions  = SentinelEx::getPermissionRepository()->findAll();
		foreach ($permissions as $key => $permission) {
			$PermissionsArray[$permission->slug] = $permission->name;
		}
        
        
        return view('users.permissions', ['roles' => $roles , 'PermissionsArray'=>$PermissionsArray]);
    }


    public function PermissionCreate()
    {

       if (Input::get('name') == '' || Input::get('slug') == '') {
      
       		return redirect()->back()->withErrors('Please fill in Permission Name and Slug')->with(['important' => true]);
       }
        $newPermission = SentinelEx::getPermissionRepository()->Create(Input::get('name'), Input::get('slug')); 
        return redirect()->back()->withSuccess(Input::get('name') . ' is successfully created.');

    }

    public function RoleCreate()
    {
        $RoleName = Input::get('name');
        $role = Sentinel::getRoleRepository()->createModel()->create([
            'name' => $RoleName,
            'slug' => Input::get('slug'),
            ]);
        return redirect()->back()->withSuccess('The role '. $RoleName . ' was successfully added.');
    }



    public function RolePermissionsUpdate($roleId, Request $request)
    {
        $role = Sentinel::findRoleById($roleId);

        if (Input::get('RolePermissions') === null) {
        	$NewPermissions = [];
        }
        else{
        $NewPermissions = array_values(Input::get('RolePermissions'));
        }
        $OldPermissions = array_keys($role->permissions);


        foreach (array_diff($NewPermissions,$OldPermissions) as $PermissionToAdd) {
        	$role->addPermission($PermissionToAdd);
        	$permission = SentinelEx::getPermissionRepository()->findBySlug($PermissionToAdd);
            $permission->roles()->attach($role);
        }

        foreach (array_diff($OldPermissions, $NewPermissions) as $PermissionToRemove) {
        	$role->removePermission($PermissionToRemove);
        	$permission = SentinelEx::getPermissionRepository()->findBySlug($PermissionToRemove);
            $permission->roles()->detach($role);
        }

        $role->save();  
        return redirect()->back()->withSuccess($role->name . ' permissions successfully updated');
    }




    public function deletePermission($PermissionId)
    {
    	$permission = SentinelEx::getPermissionRepository()->findById($PermissionId);

    	foreach ($permission->getRoles() as $role) {
    		$role->removePermission($permission->slug)->save();
    		$permission->roles()->detach($role);
    	}
    	SentinelEx::getPermissionRepository()->Destroy($PermissionId);
        
        return redirect()->back()->withSuccess('Permission successfully deleted');

    }
}
