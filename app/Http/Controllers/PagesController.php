<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Sentinel;
use SentinelEx;
use Illuminate\Support\Facades\Input;
use Validator;
class PagesController extends Controller
{
    function __construct()
    {
    	$this->middleware('SentinelAuth');
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    function homeIndex()
    {
    	return view ('home');
    }



    public function dashboardIndex()
    {
        return view ('home');
    }


    public function altiumCmpIndex()
    {
        return view ('altiumcmp');
    }

    public function myprofileIndex()
    {
        $user = Sentinel::getUser();

        if ($user->hasAccess(['admin'])) 
            {
                return redirect('/user/'.$user->id.'/edit');
            }

        $formRoute = array('profile.update');
        
        return view ('users.user',['user' => $user ,'formRoute'=>$formRoute , 'formMethod'=>'POST']);
    }

    public function profileUpdate(Request $request)
    {
        $user = Sentinel::getUser();

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
            'initials' => Input::get('initials'),
            ];

            if (Input::get('password') != ''){
                $credentials['password'] = Input::get('password');
            }
            
                $user = Sentinel::update($user, $credentials);
                $user->UpdateAvatar($request);

            
            return redirect()->back()->withSuccess('Your profile was Successfully updated')->with(['title'=>'Success']);
        
       // return Redirect()->back()->withErrors('You don\'t have the right to update your profile');
    }

    public function SVNSettingsIndex()
    {
        $user = Sentinel::getUser();

        return view('Settings.svn', ['user'=>$user]); 
    }

    public function SVNSettingsUpdate(Request $request)
    {
        $user = Sentinel::getUser();
        $user->svnUsername = Input::get('svnUsername');
        if ($request->has('svnPassword')) {
            $user->svnPassword = Input::get('svnPassword');
        }
        $user->svnPath = Input::get('svnPath');
        $user->save();

        return redirect()->back()->withSuccess('SVN settings Updated Successfully'); 
    }

    public function altiumdoc()
    {
        return view('documentation.altium-doc');
    }

    public function projdoc()
    {
        return view('documentation.proj-doc');
    }
}
