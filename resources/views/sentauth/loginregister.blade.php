@extends('layouts.guestview')


@section('content')

<style type="text/css">

  #avatar {
   opacity: 0;
   position: absolute;
   z-index: -1;
 }    
</style>


<div class="login-box">
  <div class="login-logo">
    <a href="http://www.yamaichi.de"><b>Yamaichi</b> App</a>
  </div>

  <div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
      <li class="{{ Request::is('login') ? 'active' : '' }}"><a href="#Login" data-toggle="tab" aria-expanded="true">Login</a></li>
      <li class="{{ Request::is('register') ? 'active' : '' }}"><a href="#Register" data-toggle="tab" aria-expanded="false">Register</a></li>
    </ul>
    <div class="tab-content">

      <!-- ******************************************  Login Tab  ********************************* -->

      <div class="tab-pane {{ Request::is('login') ? 'active' : '' }}" id="Login">
        <div class="login-box-body">
          <img class="img-square" width="100%" src="{{ asset ("/img/ylogo.png") }}"><br><br>
          <p class="login-box-msg">Sign in to start your session</p> 
          @if ($errors->has('NotActivated'))
          <br>
          <div class="alert alert-warning alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-warning"></i> Sorry!</h4>
            {{ $errors->first('NotActivated') }}

          </div>
          @endif
          @if ($errors->has('auth_failed'))
          <br>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Sorry!</h4>
            {{ $errors->first('auth_failed') }}

          </div>
          @endif

          @if ($errors->has('throttle'))
          <br>
          <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-ban"></i> Sorry!</h4>
            {{ $errors->first('throttle') }}

          </div>
          @endif



          <form action="{{ url('login') }}" method="post">
            {{ csrf_field() }}
            <div class="form-group has-feedback">
              <input type="email"  class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>

            </div>
            <div class="form-group has-feedback">
              <input type="password" class="form-control" placeholder="Password" name="password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>

            <div class="row">
              <div class="col-xs-8">
                <div class="checkbox iCheck" name="rememberme">
                  <label>
                    <input type="checkbox" name="remember" id="remember" value="false"> Remember Me
                  </label>
                </div>
              </div>
              <!-- /.col -->
              <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
          <a href="" data-toggle="modal" data-target="#repassModal">I forgot my password</a><br>
        </div>
        <!-- /.login-box-body -->
      </div>
      <!-- /.tab-pane -->

      <!-- ******************************************  Register Tab  ******************************************** -->

      <div class="tab-pane  {{ Request::is('register') ? 'active' : '' }}" id="Register">
        <div class="register-box-body">
          <img class="img-square" width="100%" src="{{ asset ("/img/ylogo.png") }}"><br><br>
          <p class="login-box-msg">Register a new membership</p>
          @if (Session()->has('success'))
          <br>
          <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <h4><i class="icon fa fa-check"></i> Congratulations!</h4>
            {{ Session::get('success') }}

          </div>
          @endif

          <form action="{{ url('register') }}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <div class="form-group {{ $errors->has('first_name') ? ' has-error' : '' }} has-feedback">
              <input type="text" class="form-control" placeholder="First name" name="first_name" value="{{old('first_name')}}">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
              @if ($errors->has('first_name'))
              <span class="help-block">
                <strong>{{ $errors->first('first_name') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-group {{ $errors->has('last_name') ? ' has-error' : '' }} has-feedback">
              <input type="text" class="form-control" placeholder="Last name" name="last_name" value="{{old('last_name')}}">
              <span class="glyphicon glyphicon-user form-control-feedback"></span>
              @if ($errors->has('last_name'))
              <span class="help-block">
                <strong>{{ $errors->first('last_name') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }} has-feedback">
              <input type="text" class="form-control" placeholder="Title" name="title" value="{{old('title')}}">
              <span class="glyphicon glyphicon-tags form-control-feedback"></span>
              @if ($errors->has('title'))
              <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
              <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}">
              <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              @if ($errors->has('email'))
              <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-group {{ $errors->has('departement') ? ' has-error' : '' }} has-feedback">
              <select class="form-control" placeholder="Departement" name="departement" value="{{old('departement')}}">
                <option>DEV</option><option>CS1</option><option>CS2</option><option>TS</option><option>Test</option>

              </select>
              <span class="glyphicon glyphicon-home form-control-feedback"></span>
              @if ($errors->has('departement'))
              <span class="help-block">
                <strong>{{ $errors->first('departement') }}</strong>
              </span>
              @endif
            </div>


            <div class="form-group {{ $errors->has('initials') ? ' has-error' : '' }} has-feedback">
              <input type="text" class="form-control" placeholder="Initials" name="initials">
              
              @if ($errors->has('initials'))
              <span class="help-block">
                <strong>{{ $errors->first('initials') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }} has-feedback">
              <input type="password" class="form-control" placeholder="Password" name="password">
              <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              @if ($errors->has('password'))
              <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
              </span>
              @endif
            </div>

            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }} has-feedback">
              <input type="password" class="form-control" placeholder="Retype password" name="password_confirmation">
              <span class="glyphicon glyphicon-repeat form-control-feedback"></span>
            </div>

            <div class="form-group {{ $errors->has('avatar') ? ' has-error' : '' }} has-feedback">
              <label class="btn btn-success" for="avatar"><i class="fa fa-upload"></i>&nbsp&nbsp     Upload Avatar </label>
              <input type="file" name="avatar" id="avatar" />
            </div>
            <div class="row">
              <div class="col-xs-8">

              </div>



              <!-- /.col -->
              <div class="col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
              </div>
              <!-- /.col -->
            </div>
          </form>
        </div>
      </div>
      <!-- /.tab-pane -->

      <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
  </div>

  <!-- /.login-logo -->

</div>
<!-- /.login-box -->

<!-- ******************************************  Password reset Modal  ******************************************** -->

<div class="modal fade" id="repassModal" 
tabindex="-1" role="dialog" 
aria-labelledby="repassModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" 
      data-dismiss="modal" 
      aria-label="Close">
      <span aria-hidden="true">&times;</span></button>
      <h4 class="modal-title" 
      id="repassModalLabel">Request reset Code</h4>
    </div>
    <div class="modal-body">
     <form action="{{ url('pwd-reset') }}" method="POST" class="form-horizontal">
       {{csrf_field()}}
       <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>

        <div class="col-sm-10">
          <input type="email" class="form-control" id="email" name="email" placeholder="Email">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" 
        class="btn btn-default" 
        data-dismiss="modal">Close</button>
        <span class="pull-right">
          <button type="submit" class="btn btn-primary">
            Submit
          </button>
        </span>
      </div>
    </form>
  </div>

</div>
</div>
</div>

<script type="text/javascript">

  $('#remember').on('ifChecked', function(event){
    $('#remember').val(true);
  }); 

  $('#remember').on('ifUnchecked', function(event){
    $('#remember').val(false);
  }); 
</script>

@endsection