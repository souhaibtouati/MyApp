<?php

use Illuminate\Database\Seeder;
use App\Users\EloquentPermission;
class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('users')->truncate();
    	DB::table('roles')->truncate();
    	DB::table('role_users')->truncate();
    	$role = [
    	'name' => 'Administrator',
    	'slug' => 'administrator',
    	'permissions' => [
    	'admin' => true,
    	]
    	];
    	$adminRole = Sentinel::getRoleRepository()->createModel()->fill($role)->save();

    	$UserRole = [
    	'name' => 'User',
    	'slug' => 'user',
    	];
    	Sentinel::getRoleRepository()->createModel()->fill($UserRole)->save();
    	$admin = [
    	'email'    => 'souhaib.touati@gmail.com',
    	'password' => 'admin123',
    	'first_name' => 'Souhaib',
    	'last_name' => 'touati',
    	'initials'=>'STO',
    	'departement'=>'DEV'
    	];

    	$adminUser = Sentinel::registerAndActivate($admin);
    	$adminUser->roles()->attach($adminRole);

    	$permission = new EloquentPermission;
    	$permission->name = 'Administrator';
    	$permission->slug = 'admin';
    	$permission->save();

    	$Models = ['Capacitor', 'Command', 'Connector', 'Control', 'Diode', 'Inductor', 'Others', 'PWR', 'Resistor', 'Signal', 'Transistor'];
    	foreach ($Models as $key => $model) {
    		DB::table('svnrepos')->insert([
    			'model'=>$model,
    			'type'=>'SYM',
    			'repo'=>'SYM/'.$model
    			]);

    		DB::table('svnrepos')->insert([
    			'model'=>$model,
    			'type'=>'FTPT',
    			'repo'=>'FTPT/'.$model
    			]);
    	}


    }
}
