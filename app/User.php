<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cartalyst\Sentinel\Users\EloquentUser;
use Illuminate\Http\Request;
use Image;
use Sentinel;
use File;

class User extends EloquentUser
{

    protected $fillable = [
    	'email',
        'password',
        'first_name',
        'last_name',
        'title',
        'initials',
        'permissions',
        'avatar',
        'departement',
        'svnUsername',
        'svnPath',
    ];

    /**
     * {@inheritDoc}
     */
    protected $hidden = [
        'password',
        'svnPassword',
    ];


     /**
     * Set avatar attribute.
     *
     * @param  string  $avatar
     * @return void
     */
    public function setAvatarAttribute($avatar= null)
    {
        $this->attributes['avatar'] = $avatar ? $avatar : 'default-avatar.jpg';
    }

         /**
     * Set Title attribute.
     *
     * @param  string  $title
     * @return void
     */
    public function setTitleAttribute($title)
    {
        $this->attributes['title'] = $title;
    }

    /**
     * return avatar Attribute.
     *
     * @return string
     */

    public function getTitle()
    {
        return $this->attributes['title'];
    }



    public function getGroup()
    {
        return $this->attributes['departement'];
    }

        /**
     * return title Attribute.
     *
     * @return string
     */

    public function getAvatar()
    {
        return $this->attributes['avatar'];
    }

    /**
     * Update avatar picture.
     *
     * @param  Request  request
     * @return filename or false
     */
    public function UpdateAvatar(Request $request)
    {

    	if($request->hasFile('avatar'))
    	{
        
            $deleted = $this->DeleteAvatar($this->avatar);

			$avatar = $request->file('avatar');
			$filename = time(). $this->first_name . $this->last_name . '.' . $avatar->getClientOriginalExtension();
			Image::make($avatar)->resize(300,300)->save(public_path('/img/avatars/'.$filename));
			$this->avatar = $filename;
			$this->save();
			return $filename;
    	}
    	return false;
    }


    /**
     * Get the user's full name by concatenating the first and last names
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
    
        public function isActive($user)
    {
    
        $activation = Activation::completed($user);
        return $activation ? 'complete' : 'not active';
    }

    public static function getRolesArray()
    {
        $roles = Sentinel::getRoleRepository()->all();
        $roles_names =[''=>''];
        foreach ($roles as $role) {
            $roles_names[$role->slug] = $role->name;
        }
        return $roles_names;
    }

    protected function DeleteAvatar($avatar = null)
    {
       
        if($avatar === 'default-avatar.jpg')
        {
            return "default avatar could not be deleted";
        }
        if($avatar != null){
           if (File::exists('img/avatars/'. $avatar)) {
            return File::delete('img/avatars/'. $avatar);
        }
        }
        
        
        return false;
    }
}
