@extends('layouts.master')

@section ('head')
<!-- datatables -->
<link href="{{ asset("/plugins/datatables/dataTables.bootstrap.css") }}" rel="stylesheet" type="text/css" />
<!-- jQuery datatables -->
<script src="{{ asset("/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<!-- bootstrap datatables -->
<script src="{{ asset("/plugins/datatables/dataTables.bootstrap.min.js")}}"></script>
@endsection

@section('content-header')
	<h1><i class="fa fa-bar-chart"></i><b> Yamaichi</b> Projects</h1>
@endsection

@section('content')

<div class="box box-primary">
<div class="box-header">

	<button class="btn btn-success pull-left" data-toggle="modal" data-target="#CreateModal"><i class="fa fa-plus"></i> New Project</button>
<div class="btn-group pull-right">
	<button class="btn btn-default {{(Request::route('group') === 'dev') ? 'active' : '' }}" onclick="location.href = '/yproject/show/dev'"><i class="fa fa-list"></i> DEV</button>
	<button class="btn btn-default {{(Request::route('group') === 'cs1') ? 'active' : '' }}" onclick="location.href = '/yproject/show/cs1'"><i class="fa fa-list"></i> CS1</button>
	<button class="btn btn-default {{(Request::route('group') === 'cs2') ? 'active' : '' }}" onclick="location.href = '/yproject/show/cs2'"><i class="fa fa-list"></i> CS2</button>
	<button class="btn btn-default {{(Request::route('group') === 'ts') ? 'active' : '' }}" onclick="location.href = '/yproject/show/ts'"><i class="fa fa-list"></i> TS</button>
	</div>
	
</div>
<div class="box-body">
	<table class="table table-hover" id="proj-table">
	<thead>
		<tr>
			<th>Project</th>
			<th>Description</th>
			<th>Solid W</th>
			<th>Genesis W</th>
			<th>Planta</th>
			<th>Product</th>
			<th>Customer</th>
			<th>Application</th>
			<th>Responsible</th>
			<th>Created By</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($projects as $project)
		<tr>
			<td>{{$project->ProjNumber}}</td>
			<td>{{$project->Description}}</td>
			<td>{{$project->SolidW}}</td>
			<td>{{$project->GenesisW}}</td>
			<td>{{$project->Planta}}</td>
			<td>{{$project->ProductType}}</td>
			<td>{{$project->Customer}}</td>
			<td>{{$project->Application}}</td>
			<td>{{$project->Responsible}}</td>
			<td>{{$project->Created_By}}</td>
			<td style="white-space: nowrap; display: inline-flex;">
			<div class="input-group">
				<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action &nbsp<span class="fa fa-caret-down"></span></button>
			<ul class="dropdown-menu" style="min-width: 100px">
				<li><a href="/yproject/{{$project->id}}/view"><i class="fa fa-eye"></i>View</a></li>
				<li><a href="/yproject/{{$project->id}}/edit"><i class="fa fa-edit"></i>Edit</a></li>
				<li><a href="/yproject/{{$project->id}}/copy"><i class="fa fa-copy"></i>Copy</a></li>
				<li><a href="/yproject/{{$project->id}}/newrev"><i class="fa fa-recycle"></i>New Revision</a></li>
			</ul> 
			</div>

				{{ Form::open(['url' => '/yproject/' . $project->id . '/delete', 'method' => 'DELETE', 'class'=>'delete']) }}
          		{{ Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'id'=>'delete', 'data-toggle'=>'modal','data-target'=>'#confirmDelete'])}}
          		{{ Form::close() }}
			</td>
			</tr>
		@endforeach
	</tbody>
</table>
</div>
</div>
@include('partials.deletemodal')

<div class="modal fade" id="CreateModal" role="dialog" aria-labelledby="CreateModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 800px">
    <div class="modal-content">
      <div class="modal-header" style="background-color: #23B562">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" style="color:white"><i class="fa fa-plus"></i> New Project</h4>
      </div>
      <div class="modal-body">

			{{Form::open(['url'=>'yproject/create'])}}
			<input type="hidden" name="Group" value="{{ Request::route('group') }}">
				
				<div class="row">
				<div class="col-md-4">
				{{Form::label('ProductType', 'Project Type')}}
				{{Form::select('ProductType',['PCB'=>'PCB','K'=>'Kit','Module'=>'Module','Connector'=>'Connector','Software'=>'Software',  'Socket'=>'Socket', 'BurnIn'=>'BurnIn' ],null,['class'=>'form-control'])}}
				</div>

				<div class="col-md-6">
				{{Form::label('PartNumber', 'Part Number')}}
				<div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" id="PartNumberCheck" checked="true">
                        </span>
                    <input type="text" name="PartNumber" id="PartNumber" class="form-control" required="true">
                  </div>
				</div>

				<div class="col-md-8">
				{{Form::label('Description', 'Description')}}
				{{Form::text('Description', null,['class'=>'form-control'])}}
				</div>

				</div> <!-- form group -->
				
				<hr>
				<div class="row">


				<div class="col-md-4">
				{{Form::label('GenesisW', 'Genesis world')}}
				<div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" id="GenesisWCheck" checked="true">
                        </span>
                    <input type="text" name="GenesisW" id="GenesisW" class="form-control" required="true">
                  </div>
				</div>

				<div class="col-md-4">
				{{Form::label('Planta', 'Planta')}}
				<div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" id="PlantaCheck" checked="true">
                        </span>
                    <input type="text" name="Planta" id="Planta" class="form-control" required="true">
                  </div>
				</div>

				</div> <!-- form group -->

				<hr>
				<div class="row">
				<div class="col-md-4">
				{{Form::label('Application', 'Application')}}
				{{Form::select('Application',['Automotive'=>'Automotive', 'Y-Circ M12'=>'Y-Circ M12', 'Y-CircP'=>'Y-CircP', 'Industrial'=>'Industrial','Internal'=>'Internal', 'Medical'=>'Medical','Semicomductor'=>'Semicomductor', 'Telecom'=>'Telecom'],null,['class'=>'form-control'])}}

				</div>

				<div class="col-md-4">
				{{Form::label('Customer', 'Customer')}}
				<div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" id="CustomerCheck" checked="true">
                        </span>
                    <input type="text" name="Customer" id="Customer" class="form-control" required="true">
                  </div>
				</div>

				<div class="col-md-4">
				{{Form::label('Responsible', 'Responsible')}}
				{{Form::text('Responsible', null,['class'=>'form-control', 'required'=>'true'])}}
				</div>

				</div>

			
		</div>

 	
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        {{ Form::button('<i class="fa fa-save"></i> Save' , ['class'=>'btn btn-success ', 'type'=>'submit'])}}
        {{Form::close()}}
      </div>
      </div></div></div>
  </div>

@endsection

@section('footer')

<script type="text/javascript">
	$('#proj-table').DataTable({
		"ordering": false
	});

	$(document).ready(function(){
		$(':checkbox').change(function(){
			var id = $(this).attr('id').replace('Check','');
			if (this.checked) {
			$('#'+id).prop('disabled', false);
			}
			else {
			$('#'+id).prop('disabled', true);	
			}
			
		});
	});
</script>

@endsection