<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;
use App\Http\Requests;
use App\Http\Middleware;




class AdminController extends Controller
{
    public function __construct()
    {
    	$this->middleware('Admin');
    }


    public function home()
    {
    	return view ('adminhome');
    }


    public function UsersIndex()
    {
        $users = Sentinel::getUserRepository()->all();
        return view ('users.users', ['page_title' => 'Manage Users', 'page_description' => 'Manage all users', 'users' => $users ]);
    }



     public function deleteRole($roleId)
    {

        $role = Sentinel::findRoleById($roleId);
        
        $role->users()->detach();
        $role->permissions()->detach();
        if($role->delete()){
        return redirect()->back()->withSuccess('Role successfully deleted');
        }
        return redirect()->back()->withErrors('Could not delete this role');

    }

}


