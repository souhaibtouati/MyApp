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
<h1><i class="fa fa-bar-chart"></i><b> Yamaichi</b> Projects
	<button class="btn btn-success pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> New Project</button>
</h1>

@endsection

@section('content')

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog" style="background-color: transparent;">
	<div class="modal-dialog" style="width: 70%; margin-top: 10%">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-body" style="padding: 0">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">New Project</h3>
					</div>
					<div class="box-body" style="padding: 20px">
						{{Form::open(['url'=>'yproject/save'])}}

						<div class="row">
							<div class="col-md-2">
								{{Form::label('PCBType', 'Project Type')}}
								<select class="form-control" id="PCBType" name="PCBType">
									<option value="Qualification Board">Qualification Board</option>
									<option value="HF Test board">HF Test board</option>
									<option value="Internal PCB">Internal PCB</option>
									<option value="Rigid-Flex">Rigid-Flex</option>
									<option value="Flex">Flex</option>
									<option value="Solderability Test">Solderability Test</option>
									<option value="Customer">Customer</option>
								</select>
							</div>

							<div class="col-md-2">
								{{Form::label('ProjNbr', 'Project Number')}}
								{{Form::text('ProjNbr', null,['class'=>'form-control'])}}
							</div>
							
						</div> <!-- form group -->
						<br>
						<div class="row">
							<div class="col-md-8">
								{{Form::label('Description', 'Description')}}
								{{Form::text('Description', null,['class'=>'form-control'])}}
							</div>
						</div>
						<br>
						<div class="row">

							<div class="col-md-2">
								{{Form::label('BIOS', 'BIOS Number')}}
								{{Form::text('BIOS', null,['class'=>'form-control'])}}
							</div>

							<div class="col-md-2">
								{{Form::label('Planta', 'Planta')}}
								{{Form::text('Planta', null,['class'=>'form-control'])}}
							</div>


							<div class="col-md-2">
								{{Form::label('SolidW', 'Connector Number')}}
								{{Form::text('SolidW', null,['class'=>'form-control', 'id'=>'conn_num'])}}
							</div>

						</div>
						<br>
						<div class="row">
							<div class="form-group col-md-2">
								{{Form::label('Conn_typ', 'SMD')}}
								{{Form::radio('Conn_typ', 'SMD', true,['class'=>'form-control'])}}
								{{Form::radio('Conn_typ', 'THT', false,['class'=>'form-control'])}}
								{{Form::label('Conn_typ', 'THT')}}
							</div>

							<div class="col-md-2">
								<label>Stencil</label>
								<input type="checkbox" name="stencil" id="stencil" class="checkbox iCheck">

							</div>
						</div>

						<div class="col-md-12" style="margin-top: 20px">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
							{{ Form::button('<i class="fa fa-save"></i> Save' , ['class'=>'btn btn-success pull-right', 'type'=>'submit'])}}
						</div>
						{{Form::close()}}

					</div>

				</div>
				<!-- New Project div -->
			</div>
		</div>

	</div>
</div>


<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title"><i class="fa fa-filter"></i> Filter</h3>
	</div>

	<div class="box-body">
		<div class="form-group col-md-3">
			<label>PCB Type</label>
			<select class="form-control" id="pcb_type">
				<option value=""></option>
				<option value="Qualification Board">Qualification Board</option>
				<option value="HF Test board">HF Test board</option>
				<option value="Internal PCB">Internal PCB</option>
				<option value="Rigid-Flex">Rigid-Flex</option>
				<option value="Flex">Flex</option>
				<option value="Solderability Test">Solderability Test</option>
				<option value="Customer">Customer</option>
			</select>
		</div>

		<div class="form-group col-md-3">
			<label>PCB Status</label>
			<select class="form-control" id="pcb_status">
				<option value=""></option>
				<option value="Design">Design</option>
				<option value="Quotation">Quotation</option>
				<option value="Approval">Approval</option>
				<option value="Order">Order</option>
				<option value="Delivery">Delivery</option>
				<option value="Cancel">Cancel</option>
			</select>
		</div>

		<div class="form-group col-md-3">
			<label>Stencil Status</label>
			<select class="form-control" id="stencil_status">
				<option value=""></option>
				<option value="Design">Design</option>
				<option value="Quotation">Quotation</option>
				<option value="Approval">Approval</option>
				<option value="Order">Order</option>
				<option value="Delivery">Delivery</option>
				<option value="Cancel">Cancel</option>
			</select>
		</div>
	</div>
</div>

<div class="box box-primary">
	<div class="box-header">

<!-- <div class="btn-group pull-right">
	<button class="btn btn-default {{(Request::route('group') === 'dev') ? 'active' : '' }}" onclick="location.href = '/yproject/show/dev'"><i class="fa fa-list"></i> DEV</button>
	<button class="btn btn-default {{(Request::route('group') === 'cs1') ? 'active' : '' }}" onclick="location.href = '/yproject/show/cs1'"><i class="fa fa-list"></i> CS1</button>
	<button class="btn btn-default {{(Request::route('group') === 'cs2') ? 'active' : '' }}" onclick="location.href = '/yproject/show/cs2'"><i class="fa fa-list"></i> CS2</button>
	<button class="btn btn-default {{(Request::route('group') === 'ts') ? 'active' : '' }}" onclick="location.href = '/yproject/show/ts'"><i class="fa fa-list"></i> TS</button>
	</div>
-->

</div>
<div class="box-body">
	<table class="table table-hover" id="proj-table">
		<thead>
			<tr>
			<th></th>
				<th>Project</th>
				<th>Description</th>
				<th>Type</th>
				<th>Connector</th>
				<th>Planta</th>
				<th>Created By</th>
				<th>PCB</th>
				<th>Stencil</th>
				
			</tr>
		</thead>
		<tbody>
			@foreach($projects as $project)
			<tr>
			<td>
					<!-- <div class="input-group">
						<button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">Action &nbsp<span class="fa fa-caret-down"></span></button>
						<ul class="dropdown-menu" style="min-width: 100px">
							<li><a href="/yproject/{{$project->id}}/view"><i class="fa fa-eye"></i>View</a></li>
							<li><a href="/yproject/{{$project->id}}/edit"><i class="fa fa-edit"></i>Edit</a></li>
							<li><a href="/yproject/{{$project->id}}/copy"><i class="fa fa-copy"></i>Copy</a></li>
							<li><a href="/yproject/{{$project->id}}/newrev"><i class="fa fa-recycle"></i>New Revision</a></li>
						</ul> 
					</div> -->
					<a class="btn btn-primary" href="{{url('/yproject/'.$project->id.'/view')}}"><i class="fa fa-external-link"></i></a>
					
				</td>
				<td>{{$project->ProjNbr}}</td>
				<td>{{$project->Description}}</td>
				<td>{{$project->PCBType}}</td>
				<td>{{$project->SolidW}}</td>
				<td>{{$project->Planta}}</td>
				<td>{{$project->Created_By}}</td>
				<td style="background-color: {{$project->getOrderStatusColor('PCB')}}">{{$project->getOrderStatusName('PCB')}}</td>
				<td style="background-color: {{$project->getOrderStatusColor('Stencil')}}">{{$project->getOrderStatusName('Stencil')}}</td>
				
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
</div>
<div class="col-md-12" style="display: inline; margin-bottom: 50px">
	@foreach(App\YProjects\order::getStatusList() as $status)
	<div class="col-lg-1" style="height: 15px; width: 15px; background-color: {{$status['color']}};"></div>
	<span class="col-lg-1">{{$status['name']}}</span>
	@endforeach
</div>
@include('partials.deletemodal')


</div>

@endsection

@section('footer')

<script type="text/javascript">
	var projtab = $('#proj-table').DataTable({
		"ordering": false
	});

	$(document).ready(function(){
		$('#pcb_type').change(function(){
			projtab.column(3).search(this.value).draw();
		});
		$('#pcb_status').change(function(){
			projtab.column(7).search(this.value).draw();
		});
		$('#stencil_status').change(function(){
			projtab.column(8).search(this.value).draw();
		});
	});

</script>
<script type="text/javascript">
	$(function () {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
  });
	});

	$('#stencil').on('ifChecked', function(event){
		$('#Stencil_Manuf').prop('disabled',false);
	});
	$('#stencil').on('ifUnchecked', function(event){
		$('#Stencil_Manuf').prop('disabled',true);
	});

</script>

@endsection