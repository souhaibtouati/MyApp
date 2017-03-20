<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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


class LogRegController extends Controller
{
    function __construct()
    {
    	//If user logged in -> Redirect to home page
    	$this->middleware('loggedin',['except' => 'logout']);
    }

// Application Landing route..................................

	/**
	 * Application Landing page
	 *
	 * @return void
	 * @author 
	 **/
	public function rootshow()
	{
		return redirect()->to('login');
	}


// Authentication...............................................


	public function AuthenticationIndex()
	{
		
		return view('sentauth.loginregister');
	}


	/**
	 * Authenticate a user
	 *
	 * @return void
	 * @author 
	 **/

	public function LoginPost(Request $request)
	{
		
		
		if ($auth = Sentinel::authenticate(Input::all(), $request->remember))
		{

			return Redirect::to('home');
			
		}

		

		return redirect('login')
		->withInput()
		->withErrors(['auth_failed'=> Lang::get('auth.auth_failed')]);


		
	}


	/**
	 * logout current user
	 *
	 * @return void
	 * @author 
	 **/
	public function logout()
	{
		if ($user = Sentinel::check()){
			Sentinel::logout($user);
			return redirect('/');
		}
	}


// Registration.....................................................

/**
	 * Registers user in the database
	 *
	 * @return void
	 * @author 
	 **/	
	public function RegisterPost(Request $request)
	{
	
		$validator = Validator::make($request->all(), [
            'first_name' => 'required|max:255|',
			'last_name' => 'required|max:255|',
			'tite' => 'registered|max:255',
			'initials'=>'required|max:5',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return redirect('register')
                        ->withErrors($validator)
                        ->withInput();
        }

	
		if ($user = Sentinel::register(Input::all()))
		{
			
			$user->UpdateAvatar($request);
			$role = Sentinel::findRoleByName('User');
			$role->users()->attach($user);
			$activation = Activation::create($user);
			return redirect('register')
			->withsuccess( Lang::get('auth.registered'));
		}

		
	}




// Password Reset................................................

	 /**
	 * Show Password reset Page
	 *
	 * @return void
	 * @author 
	 **/
	public function PassResetIndex()
	{
		return view ('sentauth.passreset');
	}


	/**
	 * generate reset password email
	 *
	 * @return void
	 * @author 
	 **/
	public function NewPassRequest(Request $request)
	{
		$email = Input::get('email');
		//check if email adress exists
		if ($user = Sentinel::findByCredentials(['email' => $email])) {
			
			Reminder::removeExpired();
			//if reminder exist
			if (! $reminder = Reminder::exists($user)) {
				//generate reminder
			$reminder = Reminder::create($user);			
			}
			LogRegController::sendEmailReminder($reminder->code, $user);
			return redirect('pwd-reset')->with($email);	
			
		}
		else {return view('errors.500');}
	}	


	/**
	 * Store new password
	 *
	 * @return void
	 * @author 
	 **/
	function PassResetUpdate(Request $request)
	{

		$this->validate($request, [
			'email' => 'required|email|max:255',
			'newpassword' => 'required|min:6|confirmed',
			'Code' => 'required',
			]);

			
			if ($user = Sentinel::findByCredentials(['email' => Input::get('email')])) {

				$code = Input::get('Code');
				$password = Input::get('newpassword');

				if (! Reminder::complete($user, $code, $password)){
						return redirect()->back()->withInput()
						->withErrors(['reset_pass_failed'=> Lang::get('auth.reset_pass_failed')]);
				}
				
				return redirect()->back()->withsuccess( Lang::get('auth.reset_pass_success'));

			}
	}	



	/**
	 * Send Email for pass reset
	 *
	 * @return void
	 * @author 
	 **/
 public function sendEmailReminder($code, $user)
    {

        Mail::send('emails.reminder', ['user' => $user, 'code' => $code], function ($m) use ($user) {
            $m->from('postmaster@yamaichi.de', 'Yamaichi Electronics');

            $m->to($user->email, $user->first_name .' '. $user->last_name)->subject('Password Reset!');
        });
    }


}

