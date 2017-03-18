<div class="modal-body" style="padding: 0">
	<div class="box box-primary">
		
		@if($orderStatus == 1)
		<div class="box-header">
			<h3 class="box-title">Prepare Quotation</h3>
		</div>
		<div class="box-body">

		{{Form::open(['url'=>'/yproject/order/'.$orderId.'/quotation'])}}
		{{Form::label('manufacturer', 'Manufacturer')}}
		

		{{Form::close()}}

		</div>

		@endif

		@if($orderStatus == 2)
		<div class="box-header">
			<h3 class="box-title">Offer Received</h3>
		</div>
		<div class="box-body">
		{{Form::open(['url'=>'/yproject/order/'.$orderId.'/offer'])}}

		{{Form::close()}}

		</div>

		@endif

		@if($orderStatus == 3)
		<div class="box-header">
			<h3 class="box-title">Approve Order</h3>
		</div>
		<div class="box-body">
		{{Form::open(['url'=>'/yproject/order/'.$orderId.'/approve'])}}

		{{Form::close()}}

		</div>

		@endif

		@if($orderStatus == 4)
		<div class="box-header">
			<h3 class="box-title">Send Order</h3>
		</div>
		<div class="box-body">
		{{Form::open(['url'=>'/yproject/order/'.$orderId.'/order'])}}

		{{Form::close()}}

		</div>

		@endif

		@if($orderStatus == 5)
		<div class="box-header">
			<h3 class="box-title">Goods Received</h3>
		</div>
		<div class="box-body">
		{{Form::open(['url'=>'/yproject/order/'.$orderId.'/delivery'])}}



		{{Form::close()}}

		</div>

		@endif

		@if($orderStatus == 6)
		<div class="box-header">
			<h3 class="box-title">Cancel Order</h3>
		</div>
		<div class="box-body">
		{{Form::open(['url'=>'/yproject/order/'.$orderId.'/cancel'])}}

		{{Form::close()}}

		</div>

		@endif

	</div>
</div>