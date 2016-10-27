@extends('layouts.master')

@section('head')



<style type="text/css">

  #avatar {
   opacity: 0;
   position: absolute;
   z-index: -1;
 }    
</style>
@endsection

@section('content')




<div class="row">
  {{ Form::model($user, array('route' => $formRoute ,'method'=>$formMethod, 'enctype'=>'multipart/form-data')) }}
  <div class="col-md-3">
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive " src="/img/avatars/{{$user->avatar}}" alt="User profile picture" style="width:90%">


        <h3 class="profile-username text-center">{{$user->getFullName()}}</h3>

        <p class="text-muted text-center">{{$user->title}}</p>

        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>Departement</b> <a class="pull-right">{{$user->departement}}</a>
          </li>
        </ul>

        <div class="form-group {{ $errors->has('avatar') ? ' has-error' : '' }} has-feedback">
          <label class="btn btn-success btn-block" for="avatar"><i class="fa fa-upload"></i>&nbsp&nbsp     Upload Avatar </label>
          <input type="file" name="avatar" id="avatar"/>
        </div>

        <p id="avatar_path" style="text-align:center"></p>


      </div>
      <!-- /.box-body -->
      
    </div>
  </div>

  <div class="col-md-5">
    <div class="box box-success">
      <div class="panel-body">




        <h1><i class='fa fa-user'></i> User details</h1>



        <div class='form-group'>
          {{ Form::label('first_name', 'First Name') }}
          {{ Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control']) }}
        </div>

        <div class='form-group'>
          {{ Form::label('last_name', 'Last Name') }}
          {{ Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control']) }}
        </div>

        <div class='form-group'>
          {{ Form::label('email', 'Email') }}
          {{ Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control']) }}
        </div>

        <div class='form-group'>
          {{ Form::label('title', 'Title') }}
          {{ Form::text('title', null, ['placeholder' => 'Title', 'class' => 'form-control']) }}
        </div>

        <div class='form-group'>
          {{ Form::label('Departement', 'departement') }}
          {{ Form::select('departement', ['DEV' => 'DEV', 'CS1' => 'CS1', 'CS2' => 'CS2','CS3' => 'CS3', 'TS' => 'TS', 'Test Eng' => 'Test Eng'], null, array('class' => 'form-control')) }}
        </div>

        <div class='form-group'>
          {{ Form::label('password', 'Password') }}
          {{ Form::password('password', ['placeholder' => 'Password', 'class' => 'form-control']) }}
        </div>

        <div class='form-group'>
          {{ Form::label('password_confirmation', 'Confirm Password') }}
          {{ Form::password('password_confirmation', ['placeholder' => 'Confirm Password', 'class' => 'form-control']) }}
        </div>

      </div>
    </div>
  </div>
  @if (Sentinel::hasAccess('admin'))
  <div class="col-md-4">
    <div class="box box-warning">
      <div class="panel-body">
        <h1><i class="fa fa-database"></i> Admin area</h1>
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <b>User ID</b> <a class="pull-right">{{$user->id}}</a>
          </li>
          <li class="list-group-item">
            <b>Created at</b> <a class="pull-right">{{$user->created_at}}</a>
          </li>
          <li class="list-group-item">
            <b>Updated at</b> <a class="pull-right">{{$user->updated_at}}</a>
          </li>
          <li class="list-group-item">
            <b>Last Login</b> <a class="pull-right">{{$user->last_login}}</a>
          </li>
        </ul>

      </div>
    </div>

    <div class="box box-warning expanded-box">
      <div class="box-header with-border">
        <h3 class="box-title">Roles</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">
        <table class="table table-hover">
          <thead>
            <th></th>
            <th>Role</th>
            <th>Delete</th>
          </thead>
          <tbody>
            @foreach ($user->getroles() as $key => $role)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$role->name}} </td>
              <td><a>{{Form::checkbox('UserRoleDelete['.$role->id.']')}}</a></td>
            </tr> 
            @endforeach
          </tbody>
          </table>
          <br>
          {{Form::label('UserNewRoleLabel','Add Role')}}
          {{Form::select('UserNewRole',App\User::getRolesArray(),null,['Class'=>'form-control'])}}
      </div>
      <!-- /.box-body -->
    </div>



    <div class="box box-warning collapsed-box">
      <div class="box-header with-border">
        <h3 class="box-title">User Permissions</h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
          </button>
        </div>
        <!-- /.box-tools -->
      </div>
      <!-- /.box-header -->
      <div class="box-body">

        <div class="alert alert-info alert-dismissible alert-important">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <h4><i class="icon fa fa-info"></i> info!</h4>
          User will by default inherit Permissions from his role. Here you can add specific user permissions.
        </div>


        <ul class="list-group list-group-unbordered">
          @foreach ($user->permissions as $permission=>$isSet)
          <li class="list-group-item">
            <b>{{$permission}}</b><!-- <span class="pull-right">{{Form::checkbox('permissions['.$permission.']', ($isSet ? 'on': null), ($isSet ? 'on': null), ['class' => 'checkbox iCheck'])}}</span> -->
          </li>
          @endforeach
        </ul>
        <br>
        {{ Form::label('UserPermissionsLabel','Update Permissions')}}
        {{ Form::select('UserPermissions[]', SentinelEx::getPermissionArray(), array_keys($user->permissions), array('class' => 'form-control select2','multiple' ,'id'=>'UserPermissions', 'style'=>'width:100%')) }}
      </div>
      <!-- /.box-body -->
    </div>
  </div>
  @endif
  <!-- admin column end -->
</div>
<div class="row">
  <div class='form-group'>
    {{ Form::submit('save', ['class' => 'btn btn-lg btn-primary pull-right', "style" => 'width:15%; margin-right:15px;']) }}
  </div>
</div>
{{ Form::close() }}
</div>
@endsection


@section('footer')

<script type="text/javascript">
  document.getElementById("avatar").onchange = function() {
    document.getElementById("avatar_path").innerHTML = document.getElementById("avatar").value.split("\\").pop();
  };
</script>

@endsection