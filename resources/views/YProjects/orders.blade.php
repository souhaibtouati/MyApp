@extends('layouts.master')
@section ('head')
<style type="text/css">
	.average-img {
		border-radius: 0 !important;
		border: 0px !important;
	}
</style>
@endsection
@section('content-header')
<h1><i class="fa fa-eye"></i><b> Orders</b> History
</h1>
@endsection
@section('content')
<div class="col-md-4">
	<div class="box box-widget widget-user">
		<!-- Add the bg color to the header using any of the bg-* classes -->
		<div class="widget-user-header bg-teal-active">
			<h3 class="widget-user-username">Average Cost</h3>
			<h5 class="widget-user-desc">Mean value per layer per mm²</h5>
		</div>
		<div class="widget-user-image">
			<img class="img-circle average-img" src="{{asset('/img/orders/bill.png')}}" alt="bill">
		</div>
		<div class="box-footer">

			<div class="col-md-12">
				<div class="row">
					<label>Sum: </label>
					<span id="average_val"></span>
				</div>
				<div class="row">
					<label>Total Records: </label>
					<span id="total-recs"></span>
				</div>
			</div>
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
					<td class="total-price">{{($order->qty * $order->cost_piece) + $order->Initial_cost}}</td>
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

<script type="text/javascript">
	var sum = 0;
	var recs = 0;
	$(".total-price").each(function() {

		var value = $(this).text();
    // add only if the value is number
    if(!isNaN(value) && value.length != 0) {
    	sum += parseFloat(value);
    	if (parseFloat(value)) {recs++;}
    	
    }
});
	$('#average_val').html(sum);
	$('#total-recs').html(recs);
</script>
@endsection