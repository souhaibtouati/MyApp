<div class="modal-body" style="padding: 0">
	<div class="box box-primary">
		@if($order->status == 1)
		<div class="box-header">
			<h3 class="box-title">Prepare Quotation</h3>
		</div>
		<div class="box-body">
			<p>Please choose the manufacturer and Quantity</p>
			
			{{Form::open(['url'=>'/yproject/order/'.$order->id.'/quotation', 'files'=>true])}}
			
			<div class="row">
				<div class="col-md-3">
					{{Form::label('sendmail', 'Send Email', ['style'=>'margin-right: 20px'])}}
					{{Form::checkbox('sendmail',true,true,['class'=>'checkbox iCheck'])}}
					
				</div>
				<div id="files_select">
					<div class="col-md-4">
						{{Form::label('json','JSON File')}}
						{{Form::file('json', ['id'=>'json_input'])}}
					</div>

					<div class="col-md-4">
						{{Form::label('attachment','Offer Data Zip')}}
						{{Form::file('attachment', ['id'=>'attachment_input'])}}
					</div>
				</div>
			</div>

			<br>
			<div class="row">
				<div class="col-md-3">
					{{Form::label('manufacturer', 'Manufacturer')}}
					{{Form::select('manufacturer', $order->getManList(), null, ['class'=>'form-control'])}}
				</div>
				<div class="col-md-2">
					{{Form::label('qty', 'Qty')}}
					{{Form::text('qty', null, ['class'=>'form-control'])}}
				</div>
				<div class="col-md-2">
					{{Form::label('delivery', 'Delivery (days)')}}
					{{Form::text('delivery', 15, ['class'=>'form-control'])}}
				</div>
			</div>
			<br>
			<div class="col-md-12" style="margin: auto">
				<button class="btn btn-warning pull-left" id="btn-ready" type="button">Ready ?</button>
				{{ Form::button('<i class="fa fa-save"></i> Submit' , ['class'=>'btn btn-success pull-right' , 'type'=>'submit', 'style'=>'display: none', 'id'=>'quot-submit'])}}
			</div>

			{{Form::close()}}

		</div>

		@endif

		@if($order->status == 2)
		<div class="box-header">
			<h3 class="box-title">Offer Received</h3>
		</div>
		<div class="box-body">
			{{Form::open(['url'=>'/yproject/order/'.$order->id.'/offer', 'files'=>true])}}

			<div class="col-md-3">
				{{Form::label('Initial_cost', 'Initial Cost €')}}
				{{Form::text('Initial_cost', null, ['class'=>'form-control'])}}
			</div>

			<div class="col-md-3">
				{{Form::label('cost_piece', 'Cost / Piece €')}}
				{{Form::text('cost_piece', null, ['class'=>'form-control'])}}
			</div>

			{{Form::label('offer_pdf', 'Offer PDF')}}
			{{Form::file('offer_pdf')}}

			{{ Form::button('<i class="fa fa-save"></i> Submit' , ['class'=>'btn btn-success pull-right' , 'type'=>'submit'])}}


			{{Form::close()}}

		</div>

		@endif

		@if($order->status == 3)
		<div class="box-header">
			<h3 class="box-title">Approve Order</h3>
		</div>
		<div class="box-body">
			{{Form::open(['url'=>'/yproject/order/'.$order->id.'/approve'])}}

			<div class="col-md-12">
				<div class="row">
					<p>Do you want to approve this order?</p>
				</div>

				<div class="row">
					<div class="form-group">
						<label for="password" class="col-sm-2 control-label">Password</label>

						<div class="col-md-6">
							<input type="password" class="form-control" name="password" placeholder="password">
						</div>
					</div>
				</div>
				
				<div class="row">
					
					{{ Form::button('<i class="fa fa-check"></i> Yes' , ['class'=>'btn btn-success pull-right' , 'type'=>'submit'])}}
					{{Form::close()}}
					<button class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
				</div>
			</div>
			
			
		</div>
		@endif

		@if($order->status == 4)
		<div class="box-header">
			<h3 class="box-title">Send Order</h3>
		</div>
		<div class="box-body">
			{{Form::open(['url'=>'/yproject/order/'.$order->id.'/order', 'files'=>true])}}
			{{Form::label('order_json', 'Order JSON')}}
			{{Form::file('order_json')}}

			{{ Form::button('<i class="fa fa-save"></i> Submit' , ['class'=>'btn btn-success pull-right' , 'type'=>'submit'])}}
			{{Form::close()}}

		</div>

		@endif

		@if($order->status == 5)
		<div class="box-header">
			<h3 class="box-title">Goods Received</h3>
		</div>
		<div class="box-body">
			{{Form::open(['url'=>'/yproject/order/'.$order->id.'/delivery'])}}



			{{Form::close()}}

		</div>

		@endif

		@if($order->status == 6)
		<div class="box-header">
			<h3 class="box-title">Cancel Order</h3>
		</div>
		<div class="box-body">
			{{Form::open(['url'=>'/yproject/order/'.$order->id.'/cancel'])}}

			{{Form::close()}}

		</div>

		@endif

	</div>
</div>

<script type="text/javascript">
	$(function () {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
  });
	});

	$('#sendmail').on('ifChecked', function(event){
		$('#files_select').find('*').show();
	
	});
	$('#sendmail').on('ifUnchecked', function(event){
		$('#files_select').find('*').hide();
		
	});
	$('#btn-ready').click(function(){
		$('#quot-submit').show();
	});
</script>