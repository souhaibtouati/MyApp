@extends('layouts.master')

@section('content')

<!-- datatables -->
<link href="{{ asset("/plugins/datatables/dataTables.bootstrap.css") }}" rel="stylesheet" type="text/css" />
<!-- jQuery datatables -->
<script src="{{ asset("/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<!-- bootstrap datatables -->
<script src="{{ asset("/plugins/datatables/dataTables.bootstrap.min.js")}}"></script>


<div class="row">
	<div class="col-md-6">
		<div class="box box-primary">
			<div class="box-body">
				<h1><span class="fa fa-briefcase"></span> Role Permissions</h1>
				<br>
				<table class="table table-hover">
					<thead>
						<th style="width:20%">Role</th>
						<th>Permission</th>
						<th></th>
						<th></th>
					</thead>
					<tbody>
						@foreach ($roles as $role)
						<tr>
							<td>{{$role->name}}</td>
							<td>
							{{ Form::open(['url'=>'/permissions/role/edit/'.$role->id, 'method'=>'put'])}}
							{{ Form::select('RolePermissions[]', $PermissionsArray, array_keys($role->permissions), array('class' => 'form-control select2','multiple' ,'id'=>'RolePermissions', 'style'=>'width:100%'))}}
							</td>
							<td style="width:20px">{{ Form::button('<i class="fa fa-save"></i>', ['class' => 'btn btn-success pull-right', 'type'=>'submit'])}}</td>
							{{ Form::close()}}
							<td style="width:20px">
							{{ Form::open(['url' => '/permissions/role/delete/'.$role->id , 'method' => 'DELETE']) }}
							{{ Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'id'=>'delete', 'data-toggle'=>'modal','data-target'=>'#confirmDelete'])}}
							{{ Form::close()}}
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>  
	</div>


	<div class="col-md-6">
		<div class="box box-success">
			<div class="box-body">
				<h1><span class="fa fa-user-secret"></span> Permissions list</h1>
				<br>
				<table class="table table-hover" id="PermissionsTable">
					<thead>
						<th>Id</th>
						<th>Name</th>
						<th>Slug</th>
						<th></th>
					</thead>
					<tbody>
						@foreach (App\Users\EloquentPermission::all() as $permission)
						<tr>

							<td>{{$permission->id}}</td>
							<td>{{$permission->name}}</td>
							<td>{{$permission->slug}}</td>
							<td>
							{{ Form::open(['url' => '/permissions/'.$permission->id.'/destroy', 'method' => 'DELETE']) }}

							{{ Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'id'=>'delete', 'data-toggle'=>'modal','data-target'=>'#confirmDelete'])}}
							{{ Form::close()}}
							</td>
						</tr>
						@endforeach
						@include('partials.deletemodal')
					</tbody>
				</table>
			
			</div>
		</div>  
	</div>
</div>

<!-- first row end -->

<div class="row">
<div class="col-md-6">
	<div class="box box-danger">
		<div class="box-body">
		<h1><span class="fa fa-plus"></span> Add Role</h1>
			{{ Form::open(['url' => '/permissions/addrole', 'method' => 'POST']) }}
			<div class='form-group'>
				<div class="col-xs-3">
					{{ Form::label('name', 'Role Name') }}
					{{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
				</div>
				<div class="col-xs-3">
					{{ Form::label('slug', 'Role Slug') }}
					{{ Form::text('slug', null, ['placeholder' => 'Slug', 'class' => 'form-control']) }}
				</div>
				<div class="col-xs-3">
					{{ Form::button('<i class="fa fa-plus"> New Role</i>', ['class' => 'btn btn-success', 'type'=>'submit' , 'id'=>'AddRole', 'style'=>'position:relative;bottom:-25px;'])}}
				</div>
			</div>
			{{ Form::close()}}
		</div>
	</div>
</div>
	<div class="col-md-6">
				<div class="box box-danger">
			<div class="box-body">
				<h1><span class="fa fa-plus"></span> Add Permissions</h1>

				{{ Form::open(['url' => '/permissions', 'method' => 'POST']) }}
				<div class='form-group'>
					<div class="col-xs-3">
						{{ Form::label('name', 'Permission Name') }}
						{{ Form::text('name', null, ['placeholder' => 'Name', 'class' => 'form-control']) }}
					</div>
					<div class="col-xs-3">
						{{ Form::label('slug', 'Permission Slug') }}
						{{ Form::text('slug', null, ['placeholder' => 'Slug', 'class' => 'form-control']) }}
					</div>
					<div class="col-xs-3">
						{{ Form::button('<i class="fa fa-plus"> New Permission</i>', ['class' => 'btn btn-success', 'type'=>'submit' , 'id'=>'Add', 'style'=>'position:relative;bottom:-25px;'])}}
					</div>
				</div>
				{{ Form::close()}}

			</div>
		</div>
	</div>
</div>



<div class="row">
	<div class="col-md-12">
		<div class="box box-info">
			<div class="box-body">
				<h1><span class="fa fa-subway"></span> Routes Access</h1>
				<table class="table table-hover" id="RoutesTable">
					<thead>
						<th>Method</th>
						<th>Path</th>
						<th>Action</th>
						<th>Middleware</th>
					</thead>
					<tbody>
						@foreach (Route::getRoutes() as $route)
						<tr>
							<td>{{ json_encode($route->getMethods())}}</td>
							<td>{{ $route->getPath()}}</td>
							<td>{{ $route->getActionName()}}</td>
							<td>{{ json_encode($route->middleware())}}</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>






<script type="text/javascript">
	$('#RoutesTable').DataTable();
</script>

<script type="text/javascript">
	$(document).ready(function() {
		$('#PermissionsTable tr').click(function(event) {
			if (event.target.type !== 'checkbox') {
				$(':checkbox', this).trigger('click');
			}
		});
	});
</script>

@stop