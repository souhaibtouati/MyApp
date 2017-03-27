@extends('layouts.master')
@section ('head')
<style type="text/css">
	.btn-app {
		
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
	}
	.btn-app.disabled {
		background-color: #f4f4f4;
	}
</style>
@endsection

@section('content-header')
<h1><i class="fa fa-eye"></i><b> View</b> Project
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
				<a>{{$project->PCBType}}</a>
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
		<div class="input-group pull-right">
			<button class="btn btn-flat" style="background-color: {{$pcb_order->getStatusColor()}}" data-toggle="dropdown">{{$pcb_order->getStatusName()}}</button>
			<ul class="dropdown-menu" style="min-width: 100px">
				<li>
					<a type="button" data-toggle="modal" data-target="#myModal" href="" onclick="CancelOrder({{$pcb_order->id}})"><i class="fa fa-window-close"></i> Cancel order</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="box-body">

		<div class="panel">
			<table class="table" style="text-align: center; width: 50%; margin: auto">
				<tbody>
					<tr>
						<td><a class="btn btn-app {{$pcb_order->status != 1 ? 'disabled': ''}}" type="button" data-toggle="modal" data-target="#myModal" onclick="processOrder({{$pcb_order->id}})"><i class="fa fa-edit"></i>Quotation</a></td>

						<td><a class="btn btn-app {{$pcb_order->status != 2 ? 'disabled': ''}}" type="button" data-toggle="modal" data-target="#myModal" onclick="processOrder({{$pcb_order->id}})"><i class="fa fa-handshake-o"></i>Offer</a></td>

						<td><a class="btn btn-app {{$pcb_order->status != 3 ? 'disabled': ''}}" type="button" data-toggle="modal" data-target="#myModal" onclick="processOrder({{$pcb_order->id}})"><i class="fa fa-check-circle"></i>Approval</a></td>

						<td><a class="btn btn-app {{$pcb_order->status != 4 ? 'disabled': ''}}" type="button" data-toggle="modal" data-target="#myModal" onclick="processOrder({{$pcb_order->id}})"><i class="fa fa-paper-plane"></i>Order</a></td>

						<td><a class="btn btn-app {{$pcb_order->status != 5 ? 'disabled': ''}}" type="button" data-toggle="modal" data-target="#myModal" onclick="processOrder({{$pcb_order->id}})"><i class="fa fa-archive"></i>Delivery</a></td>
					</tr>
					<tr>
						<td>{{ $pcb_order->quot_date }}</td>
						<td>{{ $pcb_order->offer_date }}</td>
						<td>{{ $pcb_order->approv_date }}</td>
						<td>{{ $pcb_order->order_date }}</td>
						<td>{{ $pcb_order->delivery_date }}</td>
					</tr>
					<tr>
						<td></td><td></td><td>{{$pcb_order->approv_by}}</td><td></td><td></td>
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
					<a>{{$pcb_man ? $pcb_man->name : ''}}</a>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-2">
					<label>Email</label>
				</div>
				<div class="col-md-4">
					<a>{{$pcb_man ? $pcb_man->email1 : ''}}</a>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-2">
					<label>Phone</label>
				</div>
				<div class="col-md-4">
					<a>{{$pcb_man ? $pcb_man->phone : ''}}</a>
				</div>
			</div>
		</div>

		<div class="panel col-md-6">
			<table class="table table-hover">
				<thead>
					<tr><th>Qty</th><th>Initial Cost <i class="fa fa-euro"></i></th><th>Cost/Piece  <i class="fa fa-euro"></i></th><th>Total  <i class="fa fa-euro"></i></th><th>pdf</th></tr>
				</thead>
				<tbody>
					<td>{{$pcb_order->qty}}</td><td>{{$pcb_order->Initial_cost}}</td><td>{{$pcb_order->cost_piece}}</td><td>{{$pcb_order->Initial_cost + ($pcb_order->cost_piece * $pcb_order->qty)}}</td><td><a href="{{$pcb_order->offer_pdf}}" target="_blank" class="fa fa-file-pdf-o" style="color: red"></a></td>
				</tbody>
			</table>
		</div>

	</div>
</div>




@if($project->stencil)
<div class="box box-default">
	<div class="box-header">
		<h3 class="box-title">Stencil Order</h3>
		<div class="input-group pull-right">
			<button class="btn btn-flat" style="background-color: {{$stencil_order->getStatusColor()}}" data-toggle="dropdown">{{$stencil_order->getStatusName()}}</button>
			<ul class="dropdown-menu" style="min-width: 100px">
				<li>
					<a type="button" data-toggle="modal" data-target="#myModal" href="" onclick="CancelOrder({{$stencil_order->id}})"><i class="fa fa-window-close"></i> Cancel order</a>
				</li>
			</ul>
		</div>
	</div>
	<div class="box-body">

		<div class="panel">
			<table class="table" style="text-align: center; width: 50%; margin: auto">
				<tbody>
					<tr>
						<td><a class="btn btn-app {{$stencil_order->status != 1 ? 'disabled': ''}}" type="button" data-toggle="modal" data-target="#myModal" onclick="processOrder({{$stencil_order->id}})"><i class="fa fa-edit"></i>Quotation</a></td>

						<td><a class="btn btn-app {{$stencil_order->status != 2 ? 'disabled': ''}}" type="button" data-toggle="modal" data-target="#myModal" onclick="processOrder({{$stencil_order->id}})"><i class="fa fa-handshake-o"></i>Offer</a></td>

						<td><a class="btn btn-app {{$stencil_order->status != 3 ? 'disabled': ''}}" type="button" data-toggle="modal" data-target="#myModal" onclick="processOrder({{$stencil_order->id}})"><i class="fa fa-check-circle"></i>Approval</a></td>

						<td><a class="btn btn-app {{$stencil_order->status != 4 ? 'disabled': ''}}" type="button" data-toggle="modal" data-target="#myModal" onclick="processOrder({{$stencil_order->id}})"><i class="fa fa-paper-plane"></i>Order</a></td>

						<td><a class="btn btn-app {{$stencil_order->status != 5 ? 'disabled': ''}}" type="button" data-toggle="modal" data-target="#myModal" onclick="processOrder({{$stencil_order->id}})"><i class="fa fa-archive"></i>Delivery</a></td>
					</tr>
					<tr>
						<td>{{ $stencil_order->quot_date }}</td>
						<td>{{ $stencil_order->offer_date }}</td>
						<td>{{ $stencil_order->approv_date }}</td>
						<td>{{ $stencil_order->order_date }}</td>
						<td>{{ $stencil_order->delivery_date }}</td>
					</tr>
					<tr>
						<td></td><td></td><td>{{$stencil_order->approv_by}}</td><td></td><td></td>
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
					<a>{{$sten_man ? $sten_man->name : ''}}</a>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-2">
					<label>Email</label>
				</div>
				<div class="col-md-4">
					<a>{{$sten_man ? $sten_man->email1 : ''}}</a>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-2">
					<label>Phone</label>
				</div>
				<div class="col-md-4">
					<a>{{$sten_man ? $sten_man->phone : ''}}</a>
				</div>
			</div>
		</div>

		<div class="panel col-md-6">
			<table class="table table-hover">
				<thead>
					<tr><th>Qty</th><th>Initial Cost <i class="fa fa-euro"></i></th><th>Cost/Piece  <i class="fa fa-euro"></i></th><th>Total  <i class="fa fa-euro"></i></th><th>pdf</th></tr>
				</thead>
				<tbody>
					<td>{{$stencil_order->qty}}</td><td>{{$stencil_order->Initial_cost}}</td><td>{{$stencil_order->cost_piece}}</td><td>{{$stencil_order->Initial_cost + ($stencil_order->cost_piece * $stencil_order->qty)}}</td><td><a href="{{$stencil_order->offer_pdf}}" class="fa fa-file-pdf-o" target="_blank" style="color: red"></a></td>
				</tbody>
			</table>
		</div>

	</div>
</div>
@endif


<div id="myModal" class="modal fade" role="dialog" style="background-color: transparent;">
	<div class="modal-dialog" style="width: 60%; margin-top: 10%">
		<div class="modal-content" id="model_process">
			
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

	function processOrder(orderId, cancel = false) {
		$.ajax({
			url: '/yproject/processorder',
			headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
			type: 'POST',
			data: {orderId : orderId}
		}).success(function(data){
			$('#model_process').html(data);
		});
	}

	function CancelOrder(orderId) {
		$.ajax({
			url: '/yproject/cancelorder',
			headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
			type: 'POST',
			data: {orderId : orderId}
		}).success(function(data){
			$('#model_process').html(data);
		});
	}
</script>
@endsection