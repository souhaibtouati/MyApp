@extends('layouts.guestview')


@section('content')

<div class="info-box pull-down">
	<img src="{{ asset ("/img/ylogo.png") }}" style="width:300px">
</div>

<div class="login-box" style="width:50%">
<div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Reset Password</h3>
            </div>
            <!-- /.box-header -->
            @if ($errors->has('reset_pass_failed'))
                  <br>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Sorry!</h4>
                    {{ $errors->first('reset_pass_failed') }}

                  </div>
                  @endif

                   @if ($errors->has('user-not-found'))
                  <br>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-ban"></i> Sorry!</h4>
                    {{ $errors->first('user-not-found') }}

                  </div>
                  @endif

            @if (session()->has('success'))
                  <br>
                  <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-confirm"></i> Congratulations</h4>
                    {{ Session::get('success')}}

                  </div>
                  @endif
            <!-- form start -->
            {{Form::open(array('url' => 'pwd-reset/update/'.$id.'/'.$code, 'class' => 'form-horizontal'))}}
                
              <div class="box-body">
                
                <div class="form-group {{ $errors->has('newpassword') ? ' has-error' : '' }} has-feedback">
                  <label for="newpassword" class="col-sm-2 control-label">New Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password">
                  </div>
                </div>

                  <div class="form-group {{ $errors->has('newpassword') ? ' has-error' : '' }} has-feedback">
                  <label for="passRetype" class="col-sm-2 control-label">Retype Password</label>

                  <div class="col-sm-10">
                    <input type="password" class="form-control" id="newpassword_confirm" name="newpassword_confirmation" placeholder="Retype Password">
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <a class="btn btn-default" href="/login">Back</a>
                <button type="submit" class="btn btn-info pull-right">Reset</button>
              </div>
              <!-- /.box-footer -->
            {{ Form::close() }}
          </div>
</div>


@endsection

