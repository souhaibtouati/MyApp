@extends('layouts.master')

@section('content')

<div class="box box-default">
				<div class="box-header">
					<i class="fa fa-cloud"></i><h3 class="box-title"> SVN Settings <span class="createType"></span></h3>
				</div>
	<div class="box-body">

	{{Form::open(['url'=>'Settings/Altium/SVN/update', 'method'=>'post'])}}
	<div class="col-md-6">
	<div class="form-group">	
		{{Form::label('svnUsername', 'SVN Username')}}
		{{Form::text('svnUsername', Sentinel::getUser()->svnUsername, ['placeholder' => 'username', 'class' => 'form-control'])}}
	</div>
	</div>

	<div class="col-md-6">
	<div class='form-group'>
          {{ Form::label('svnPassword', 'SVN Password') }}
          {{ Form::password('svnPassword', ['placeholder' => 'Password', 'class' => 'form-control']) }}
    </div>
    </div>
<div class="col-md-12">
    <div class="form-group">	
		{{Form::label('svnPath', 'SVN URL')}}
		{{Form::text('svnPath', Sentinel::getUser()->svnPath, ['placeholder' => 'Path', 'class' => 'form-control'])}}
	</div>    
</div>
<div class="col-xs-3 pull-right">
	{{ Form::button('<i class="fa fa-save"></i> Save' , ['class'=>'btn btn-success ', 'type'=>'submit'])}}
</div>
	</div>	
	
	{{Form::close()}}

	</div>
</div>

@endsection