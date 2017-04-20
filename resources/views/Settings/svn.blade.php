@extends('layouts.master')

@section('content-header')
<h1><i class="fa fa-cogs"></i> <b>SVN</b> Settings</h1>
@endsection

@section('content')

<div class="box box-default">
	<div class="box-header">
		<h3 class="box-title"><i class="fa fa-user-secret"></i> My SVN Parameters</h3>
	</div>				
	<div class="box-body">

		{{Form::open(['url'=>'Settings/Altium/SVN/update', 'method'=>'post'])}}
		<div class="col-md-3">
			<div class="form-group">	
				{{Form::label('svnUsername', 'SVN Username')}}
				{{Form::text('svnUsername', $ConnectedUser->svnUsername, ['placeholder' => 'username', 'class' => 'form-control'])}}
			</div>
		</div>

		<div class="col-md-3">
			<div class='form-group'>
				{{ Form::label('svnPassword', 'SVN Password') }}
				{{ Form::password('svnPassword', ['placeholder' => 'Password', 'class' => 'form-control']) }}
			</div>
		</div>
		<div class="col-md-5">
			<div class="form-group">	
				{{Form::label('svnPath', 'SVN Library URL')}}
				{{Form::text('svnPath', $ConnectedUser->svnPath, ['placeholder' => 'Path', 'class' => 'form-control'])}}
			</div>    
		</div>
		<div class="col-md-1" style="margin-top: 25px">
			{{ Form::button('<i class="fa fa-save"></i> Save' , ['class'=>'btn btn-success ', 'type'=>'submit'])}}
		</div>
	</div>	
	
	{{Form::close()}}

</div>

<div class="box box-default">
	<div class="box-header">
		<h3 class="box-title"><i class="fa fa-link"></i> SVN Repositories</h3>
	</div>				
	<div class="box-body">
	<div class="col-md-6">
		<h3>Symbols</h3>
		<table class="table table-hover">
			<thead>
				<tr><th>Category</th><th>Repository</th><th></th></tr>
			</thead>
			<tbody>
				@foreach(\DB::table('svnrepos')->where('type','SYM')->get() as $repo)
					<tr>
						 {{Form::open(['url'=>'/Settings/SVN/repo/'.$repo->id.'/update', 'method'=>'post'])}}
						<td>{{$repo->model}}</td>
						<td>{{Form::text('repo', $repo->repo, ['class'=>'form-control', !$ConnectedUser->hasAccess('admin') ? 'disabled' : ''])}}</td>
						<td>{{Form::button('<i class="fa fa-save"></i>' , ['class'=>'btn btn-flat', 'type'=>'submit', !$ConnectedUser->hasAccess('admin') ? 'disabled' : ''])}}</td>
						 {{Form::close()}}
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	<div class="col-md-6">
		<h3>Footprints</h3>
		<table class="table table-hover">
			<thead>
				<tr><th>Category</th><th>Repository</th><th></th></tr>
			</thead>
			<tbody>
				@foreach(\DB::table('svnrepos')->where('type','FTPT')->get() as $repo)
					<tr>
						 {{Form::open(['url'=>'/Settings/SVN/repo/'.$repo->id.'/update', 'method'=>'post'])}}
						<td>{{$repo->model}}</td>
						<td>{{Form::text('repo', $repo->repo, ['class'=>'form-control', !$ConnectedUser->hasAccess('admin') ? 'disabled' : ''])}}</td>
						<td>{{Form::button('<i class="fa fa-save"></i>' , ['class'=>'btn btn-flat', 'type'=>'submit', !$ConnectedUser->hasAccess('admin') ? 'disabled' : ''])}}</td>
						 {{Form::close()}}
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>

	</div>
</div>

@endsection