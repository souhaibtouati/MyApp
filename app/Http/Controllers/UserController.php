<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\User;
use App\Http\Requests;
use Sentinel;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Cartalyst\Sentinel\Checkpoints;
use Illuminate\Support\Facades\Lang;
use Reminder;
use Activation;
use Mail;
use View;
use App\Users\EloquentPermission;
use SentinelEx;
class UserController extends Controller
{


	public function __construct()
	{
		$this->middleware('Admin');
	}

    /**
	 * Display a listing of the users.
	 *
	 * @return Response
	 */
	public function index()
	{
		$users = User::all()->sortByDesc("id");

		return View::make('users.users', ['users' => $users]);
	}

	/**
	 * Show the form for creating a new user.
	 *
	 * @return Response
	 */
	public function create()
	{
       	$formRoute = array('user.store');
       	$user = new User;
       	$user->avatar = $user->setAvatarAttribute();
		return View::make('users.user', ['user'=> $user, 'formRoute' => $formRoute, 'formMethod' => 'POST']);
	}

	/**
	 * Store a newly created user in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		
		$validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255|',
			'last_name' => 'required|max:255|',
			'tite' => 'registered|max255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                        ->withErrors($validator)->with(['important'=>true, 'title'=>'Failed'])
                        ->withInput();
        }

	
		if ($user = Sentinel::register(Input::all()))
		{
			
			$user->UpdateAvatar($request);
			$activation = Activation::create($user);
			if(Input::get('UserNewRole') === ""){
			$role = Sentinel::findRoleBySlug('user');}
			else $role = Sentinel::findRoleBySlug(Input::get('UserNewRole'));
			$role->users()->attach($user);
			
			return redirect('/user')
			->withsuccess( 'User was Successfully Created')->with(['title'=>'Congratulations']);
		}

		return false;
	}

	/**
	 * Show the form for editing the specified user.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
		$user = User::find($id);
		$formRoute = array('user.update', $user->id);
		return view('users.user', [ 'user' => $user, 'formRoute' => $formRoute, 'formMethod' => 'PATCH']);
	}

	/**
	 * Update the specified user in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Request $request)
	{
		$user = User::find($id);
		$Rules = [
            'first_name' => 'required|max:255|',
            'last_name' => 'required|max:255|',
            'email' => 'required|email|max:255',
            
            ];
         if(Input::get('email') != $user->email)
		{
			$Rules['email'] = 'required|email|max:255|unique:users';
		}
		
		$validator = Validator::make($request->all(), $Rules);
		

        if ($validator->fails()) {
            return redirect()->back()->with(['important'=> true])
            ->withErrors($validator)
            ->withInput();
        }


		$credentials = [
		'email' => Input::get('email'),
		'first_name' => Input::get('first_name'),
		'last_name' => Input::get('last_name'),
		'title' => Input::get('title'),
		'departement' => Input::get('departement'),
		'initials' => Input::get('initials')
		];

		if (Input::get('password') != ''){
			$credentials['password'] = Input::get('password');
		}

		if (Input::get('UserRoleDelete') != null) {
			foreach (Input::get('UserRoleDelete') as $RoleIDelete => $value) {
				$role = Sentinel::findRoleById($RoleIDelete);
				$role->users()->detach($user);
			}
		}

		if(Input::get('UserNewRole') != ''){
			$role = Sentinel::findRoleBySlug(Input::get('UserNewRole') );
			if($user->inRole($role)){
				return redirect()->back()->withErrors('This User belongs already to the selected role')->with(['important'=>true, 'title'=>'Failed']);
			}
			
			$role->users()->attach($user);
		}

		if(Input::get('UserPermissions') !== null)
		{
			$permissions = array_fill_keys(array_values(Input::get('UserPermissions')), true);
			
			$credentials['permissions'] = $permissions;
		}
		else $credentials['permissions'] = [];
		
		$user = Sentinel::update($user, $credentials);
		$user->UpdateAvatar($request);
		

		return Redirect::back()->withSuccess($user->getFullName() . ' was Successfully updated');
	}

	/**
	 * Remove the specified user from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		$user = Sentinel::findById($id);
		$avatar = $user->avatar;
		if ($user->delete()){
			User::DeleteAvatar($avatar);
			return Redirect::to('/user')->withSuccess('User was Successfully deleted');
		}
		return Redirect::back()->withErrors('Could not delete this user')->with(['important'=>true, 'title'=>'Failed']);

	}

	public function activate($id)
	{
		$user = Sentinel::findById($id);
		if ($activation = Activation::exists($user)) {
			$code = $activation->code;
			Activation::complete($user, $code);
			return redirect::to('/user');
		}
		return redirect::to('/user')->withErrors('could not activate user');

	}


}

