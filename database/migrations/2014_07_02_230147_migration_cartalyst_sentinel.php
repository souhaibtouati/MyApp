<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class MigrationCartalystSentinel extends Migration
{

    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('code');
            $table->boolean('completed')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
        });

        Schema::create('persistences', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('code');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('code');
        });

        Schema::create('reminders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('code');
            $table->boolean('completed')->default(0);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->text('permissions')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('slug');
        });


        Schema::create('role_users', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->nullableTimestamps();

            $table->engine = 'InnoDB';
            $table->primary(['user_id', 'role_id']);
        });

        Schema::create('permission_users', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->nullableTimestamps();

            $table->engine = 'InnoDB';
            $table->primary(['permission_id', 'user_id']);
        });

        Schema::create('permission_roles', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->nullableTimestamps();

            $table->engine = 'InnoDB';
            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug');
            $table->string('name');
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('slug');
        });
        
        Schema::create('throttle', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('type');
            $table->string('ip')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->index('user_id');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('password');
            $table->text('permissions')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('title')->nullable();
            $table->string('initials');
            $table->string('avatar')->default('default-avatar.jpg');
            $table->string('departement')->nullable();
            $table->string('svnUsername')->nullable();
            $table->string('svnPassword')->nullable();
            $table->string('svnPath')->default('http://yed-muc-ed1/svn/AltiumLib');
            $table->timestamp('last_login')->nullable();
            $table->timestamps();

            $table->engine = 'InnoDB';
            $table->unique('email');
        });

        Schema::create('svnrepos', function(Blueprint $table){
            $table->increments('id');
            $table->string('model');
            $table->string('type');
            $table->string('repo');

        });

        

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('activations');
        Schema::drop('persistences');
        Schema::drop('reminders');
        Schema::drop('roles');
        Schema::drop('role_users');
        Schema::drop('throttle');
        Schema::drop('users');
        Schema::drop('permissions');
        Schema::drop('permission_users');
        Schema::drop('permission_roles');
        Schema::drop('svnrepos');


    }
}
