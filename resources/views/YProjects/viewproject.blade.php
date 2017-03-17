@extends('layouts.master')
@section ('head')
<style type="text/css">
	.btn-success, .btn-default{
		width:100px;
		height: 50px;
	}
</style>
@endsection

@section('content-header')
<h1><i class="fa fa-eye"></i><b> View</b> Project
	<a class="btn btn-flat pull-right" style="background-color: {{$project::$StatusList[$project->Status]['color']}}">{{$project::$StatusList[$project->Status]['name']}}</a>
</h1>

@endsection

@section('content')


<div class="box box-primary">
	<div class="box-header">
		<h3 class="box-title">Project Details</h3>
	</div>
	<div class="box-body">
		
		<div class="row">
			<div class="col-md-1">
				<label>PCB Type</label>
			</div>
			<div class="col-md-2">
				<a>{{$project::$PCBTypes[$project->PCBType]}}</a>
			</div>

			<div class="col-md-1">
				<label>Description</label>
			</div>
			<div class="col-md-8">
				<a>{{$project->Description}}</a>
			</div>

		</div>
		<br>
		<div class="row">

			<div class="col-md-1">
				<label>Project</label>
			</div>
			<div class="col-md-1">
				<a>{{$project->ProjNbr}}</a>
			</div>

			<div class="col-md-1">
				<label>BIOS</label>
			</div>
			<div class="col-md-1">
				<a>{{$project->BIOS}}</a>
			</div>

			<div class="col-md-1">
				<label>Planta</label>
			</div>
			<div class="col-md-1">
				<a>{{$project->Planta}}</a>
			</div>

			<div class="col-md-1">
				<label>Connector</label>
			</div>
			<div class="col-md-1">
				<a>{{$project->SolidW}}</a>
			</div>
			
		</div>

	</div>
</div>

<div class="box box-success">
	<div class="box-header">
		<h3 class="box-title">PCB Order</h3>
		<a class="btn btn-flat pull-right" style="background-color: {{$project::$StatusList[$project->Status]['color']}}">{{$project::$StatusList[$project->Status]['name']}}</a>
	</div>
	<div class="box-body">

		<div class="panel">
			<table class="table" style="text-align: center; width: 50%; margin: auto">
				<tbody>
					<tr>
						<td><a class="btn btn-app" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i>Quotation</a></td>
						<td><a class="btn btn-app {{$project->Status < 2 ? 'disabled': ''}}" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-handshake-o"></i>Offer</a></td>
						<td><a class="btn btn-app {{$project->Status < 3 ? 'disabled': ''}}" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-check-circle"></i>Approval</a></td>
						<td><a class="btn btn-app {{$project->Status < 4 ? 'disabled': ''}}" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-paper-plane"></i>Order</a></td>
						<td><a class="btn btn-app {{$project->Status < 5 ? 'disabled': ''}}" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-archive"></i>Delivery</a></td>
					</tr>
					<tr>
						<td>12/01/1989</td>
						<td>12/01/1989</td>
						<td>12/01/1989</td>
						<td>12/01/1989</td>
						<td>12/01/1989</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="panel col-md-6">
			<div class="row">
				<div class="col-md-2">
					<label>Manufacturer</label>
				</div>
				<div class="col-md-4">
					<a>{{$pcb_man->name}}</a>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-2">
					<label>Email</label>
				</div>
				<div class="col-md-4">
					<a>{{$pcb_man->email}}</a>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-2">
					<label>Phone</label>
				</div>
				<div class="col-md-4">
					<a>{{$pcb_man->phone}}</a>
				</div>
			</div>
		</div>

		<div class="panel col-md-6">
			<table class="table table-hover">
				<thead>
					<tr><th>Qty</th><th>Initial Cost</th><th>Cost/Piece</th><th>Total</th><th>pdf</th></tr>
				</thead>
				<tbody>
					<td>12/01/1989</td><td>12/01/1989</td><td>12/01/1989</td><td>12/01/1989</td><td><a class="fa fa-file-pdf-o" style="color: red" href="/altium"></a></td>
				</tbody>
			</table>
		</div>

	</div>
</div>




@if($project->Stencil_Manuf)
<div class="box box-default">
	<div class="box-header">
		<h3 class="box-title">Stencil Order</h3>
	</div>
	<div class="box-body">

		<div class="panel">
			<table class="table" style="text-align: center; width: 50%; margin: auto">
				<tbody>
					<tr>
						<td><a class="btn btn-app" type="button" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit"></i>Quotation</a></td>
						<td><a class="btn btn-app {{$project->Status < 2 ? 'disabled': ''}}"><i class="fa fa-handshake-o"></i>Offer</a></td>
						<td><a class="btn btn-app {{$project->Status < 3 ? 'disabled': ''}}"><i class="fa fa-check-circle"></i>Approval</a></td>
						<td><a class="btn btn-app {{$project->Status < 4 ? 'disabled': ''}}"><i class="fa fa-paper-plane"></i>Order</a></td>
						<td><a class="btn btn-app {{$project->Status < 5 ? 'disabled': ''}}"><i class="fa fa-archive"></i>Delivery</a></td>
					</tr>
					<tr>
						<td>12/01/1989</td>
						<td>12/01/1989</td>
						<td>12/01/1989</td>
						<td>12/01/1989</td>
						<td>12/01/1989</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div class="panel col-md-6">
			<div class="row">
				<div class="col-md-2">
					<label>Manufacturer</label>
				</div>
				<div class="col-md-4">
					<a>{{$stencil_man->name}}</a>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-2">
					<label>Email</label>
				</div>
				<div class="col-md-4">
					<a>{{$stencil_man->email}}</a>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-2">
					<label>Phone</label>
				</div>
				<div class="col-md-4">
					<a>{{$stencil_man->phone}}</a>
				</div>
			</div>
		</div>

		<div class="panel col-md-6">
			<table class="table table-hover">
				<thead>
					<tr><th>Qty</th><th>Initial Cost</th><th>Cost/Piece</th><th>Total</th></tr>
				</thead>
				<tbody>
					<td>12/01/1989</td><td>12/01/1989</td><td>12/01/1989</td><td>12/01/1989</td>
				</tbody>
			</table>
		</div>

	</div>
</div>
@endif


<div id="myModal" class="modal fade" role="dialog" style="background-color: transparent;">
	<div class="modal-dialog" style="width: 60%; margin-top: 10%">
		<div class="modal-content">
			<div class="modal-body" style="padding: 0">
				<div class="box box-primary">
				<div class="box-header">
						<h3 class="box-title">Title</h3>
					</div>
				<div class="box-body">
					
				</div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@section('footer')
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