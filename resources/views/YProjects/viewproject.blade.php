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

<div class="col-md-5">
	
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Project Details</h3>
		</div>
		<div class="box-body">
			
			<div class="row">
				<div class="col-md-3">
					<label>PCB Type</label>
				</div>
				<div class="col-md-9">
					<a>{{$project->PCBType}}</a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label>Description</label>
				</div>
				<div class="col-md-9">
					<a>{{$project->Description}}</a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label>Requester Name</label>
				</div>
				<div class="col-md-9">
					<a>{{$project->Created_By}}</a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label>Requester Group</label>
				</div>
				<div class="col-md-9">
					<a>{{$project->Group}}</a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label>Assigned Engineer</label>
				</div>
				<div class="col-md-9">
					@if($project->engineer)
					<a>{{$project->engineer}}</a>
					@else
					<div class="input-group-btn">
						<button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#take-proj-modal" ><i class="fa fa-suitcase"></i> &nbspTake Project</button>
					</div>
					@endif

				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label>Project Number</label>
				</div>
				<div class="col-md-9">
					<a>{!! $project->ProjNbr ? $project->ProjNbr : '<span class="label label-warning">Pending</span>' !!}</a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label>Drawing Number</label>
				</div>
				<div class="col-md-9">
					<a>{{$project->SolidW}}</a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label>BIOS</label>
				</div>
				<div class="col-md-9">
					<a>{{$project->BIOS}}</a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label>Planta</label>
				</div>
				<div class="col-md-9">
					<a>{{$project->Planta}}</a>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-3">
					<label>Attachment</label>
				</div>
				<div class="col-md-9">
					<a href="{{$project->attachment}}">{{basename($project->attachment)}} &nbsp<i class="fa fa-external-link"></i></a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
					<label>Requested Qty</label>
				</div>
				<div class="col-md-9">
					<a>{{$project->req_qty}}</a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label>Due Date</label>
				</div>
				<div class="col-md-9">
					<a>{{$project->due_date}}</a>
				</div>
			</div>
			<br>

			<div class="row">
				<div class="col-md-3">
					<label>Comment</label>
				</div>
				<div class="col-md-9">
					<a style="white-space: pre">{{$project->comment}}</a>
				</div>
			</div>

		</div>
	</div> <!-- Project details box -->

	@if($project->PCBType == 'Qualification Board')
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title">Test PCB Details</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-3">
					<label>TR Number</label>
				</div>
				<div class="col-md-9">
					<a>{{$project->tr_proj}}</a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label>Connector Type</label>
				</div>
				<div class="col-md-9">
					<a>{{$project->Conn_typ}}</a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label>Contact Resistance</label>
				</div>
				<div class="col-md-9">
					<a>{!! $project->cr ? '<strong style="color: green">✓</strong>' : '<strong style="color: red">X</strong>' !!}</a>
				</div>
			</div>

			<div class="row">
				<div class="col-md-3">
					<label>High Voltage</label>
				</div>
				<div class="col-md-1">
					<a>{!! $project->hv ? '<strong style="color: green">✓</strong>' : '<strong style="color: red">X</strong>' !!}</a>
				</div>

				@if($project->hv)
				<div class="col-md-3">
					<label>Maximum Voltage</label>
				</div>
				<div class="col-md-5">
					<a>{{ $project->max_volt }}</a>
				</div>	
				@endif
			</div>

			<div class="row">
				<div class="col-md-3">
					<label>Derating</label>
				</div>
				<div class="col-md-1">
					<a>{!! $project->dr ? '<strong style="color: green">✓</strong>' : '<strong style="color: red">X</strong>' !!}</a>
				</div>
				@if($project->dr)
				<div class="col-md-3">
					<label>Maximum Current</label>
				</div>
				<div class="col-md-5">
					<a>{{ $project->max_amp }}</a>
				</div>	
				@endif
			</div>


		</div>
	</div>
	@endif
</div> 

<div class="col-md-7">

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
							<td>{{$pcb_order->quot_sender}}</td>
							<td>{{$pcb_order->offer_receiver}}</td>
							<td>{{$pcb_order->approv_by}}</td>
							<td>{{$pcb_order->ordered_by}}</td>
							<td>{{$pcb_order->delivered_to}}</td>
						</tr>
					</tbody>
					<img class="pull-right" src="{{asset('img/pcb.jpg')}}" style="width: 150px;">
				</table>

			</div>

			<div class="panel col-md-6">
				<div class="row">
					<div class="col-md-3">
						<label>Manufacturer</label>
					</div>
					<div class="col-md-5">
						<a>{{$pcb_man ? $pcb_man->name : ''}}</a>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label>Email</label>
					</div>
					<div class="col-md-5">
						<a>{{$pcb_man ? $pcb_man->email1 : ''}}</a>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label>Phone</label>
					</div>
					<div class="col-md-5">
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
							<td>{{$stencil_order->quot_sender}}</td>
							<td>{{$stencil_order->offer_receiver}}</td>
							<td>{{$stencil_order->approv_by}}</td>
							<td>{{$stencil_order->ordered_by}}</td>
							<td>{{$stencil_order->delivered_to}}</td>
						</tr>
					</tbody>
					<img class="pull-right" src="{{asset('img/stencil.png')}}" style="width: 150px;">
				</table>
			</div>

			<div class="panel col-md-6">
				<div class="row">
					<div class="col-md-3">
						<label>Manufacturer</label>
					</div>
					<div class="col-md-5">
						<a>{{$sten_man ? $sten_man->name : ''}}</a>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label>Email</label>
					</div>
					<div class="col-md-5">
						<a>{{$sten_man ? $sten_man->email1 : ''}}</a>
					</div>
				</div>

				<div class="row">
					<div class="col-md-3">
						<label>Phone</label>
					</div>
					<div class="col-md-5">
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

</div>
<div id="myModal" class="modal fade" role="dialog" style="background-color: transparent;">
	<div class="modal-dialog" style="width: 40%; margin-top: 10%">
		<div class="modal-content" id="model_process">

		</div>
	</div>
</div>

<div id="take-proj-modal" class="modal fade" role="dialog" style="background-color: transparent;">
	<div class="modal-dialog" style="width: 20%; margin-top: 10%">
		<div class="modal-content" id="take-proj-modal-content">
			<div class="modal-body" style="padding: 0;">
				<div class="box box-widget widget-user">
					<div class="widget-user-header bg-teal-active">
						<h3 class="widget-user-username">Process Project</h3>
						<h5 class="widget-user-desc">Take Project</h5>
					</div>
					<div class="widget-user-image">
						<img class="img-circle" style="border: 0; " src="{{asset('/img/business_user_accept.png')}}" alt="take">
					</div>
					<div class="box-footer">
						<br><br>
						<div class="row">
							<label class="col-md-5">Engineer</label>
							<span class="col-md-7">{{Sentinel::getUser()->initials}}</span>
						</div>

						{{Form::open(['url'=>'/yproject/'. $project->id . '/take'])}}
						<div class="row">
							<div class="form-group">
							<label for="ProjNbr" class="col-md-5 ">Project Number</label>
								<div class="col-md-7">
									<input class="form-control" name="ProjNbr" placeholder="BxxxxPxx">
								</div>
							</div>
						</div>
						<br>
						<button class="btn btn-primary" type="submit" style="margin: auto; width: 100%"><i class="fa fa-save"></i> Save</button>
						{{Form::close()}}
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

	function processOrder(orderId, cancel) {
		cancel = false;
		$.ajax({
			url: '{{url('/yproject/processorder')}}',
			headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
			type: 'POST',
			data: {orderId : orderId}
		}).success(function(data){
			$('#model_process').html(data);
		});
	}

	function CancelOrder(orderId) {
		$.ajax({
			url: '{{url('yproject/cancelorder')}}',
			headers: {'X-CSRF-TOKEN': '{{csrf_token()}}'},
			type: 'POST',
			data: {orderId : orderId}
		}).success(function(data){
			$('#model_process').html(data);
		});
	}
</script>
@endsection