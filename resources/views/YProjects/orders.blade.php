@extends('layouts.master')
@section ('head')
@endsection
@section('content-header')
<h1><i class="fa fa-eye"></i><b> Orders</b> History
</h1>
@endsection
@section('content')
<div class="col-md-4">
	<div class="box box-info">
		<div class="box-header">
			<div class="box-title">
				<h3>Average Cost</h3>		
			</div>
		</div>
		<div class="box-body">
			
		</div>
	</div>
</div>

<div class="col-md-12"><div class="box box-primary">
		<div class="box-body">
			<table class="table table-hover" id="orders-table" style="text-align: center">
				<thead>
					<tr>
						<th></th>
						<th style="text-align: center">Id</th>
						<th style="text-align: center">Type</th>
						<th style="text-align: center">Qty</th>
						<th style="text-align: center">Initial cost</th>
						<th style="text-align: center">Cost/Piece</th>
						<th style="text-align: center">Total</th>
						<th style="text-align: center">Quotation</th>
						<th style="text-align: center">Offer</th>
						<th style="text-align: center">Approval</th>
						<th style="text-align: center">Order</th>
						<th style="text-align: center">Delivery</th>
						<th style="text-align: center">Manufacturer</th>
						<th style="text-align: center">Status</th>
	
					</tr>
				</thead>
				<tbody>
					@foreach($orders as $order)
					<tr>
						<td></td>
						<td>{{$order->id}}</td>
						<td>{{$order->type}}</td>
						<td>{{$order->qty}}</td>
						<td>{{$order->Initial_cost}}</td>
						<td>{{$order->cost_piece}}</td>
						<td>{{($order->qty * $order->cost_piece) + $order->Initial_cost}}</td>
						<td>{{$order->quot_date}}</td>
						<td>{{$order->offer_date}}</td>
						<td>{{$order->approv_date}}</td>
						<td>{{$order->order_date}}</td>
						<td>{{$order->delivery_date}}</td>
						<td>{{$order->manufacturer_id ? $manufs[$order->manufacturer_id] : ''}}</td>
						<td style="background-color: {{$order->getStatusColor()}}">{{$order->getStatusName()}}</td>
	
					</tr>
	
	
					@endforeach
				</tbody>
			</table>
		</div>
	</div> <!-- box --></div>
<div>{{ $orders->links() }}</div>

@endsection

@section('footer')


@endsection