<div class="modal-body" style="padding: 0">
	<div class="box box-danger">
		<div class="box-header">
			<h3 class="box-title">Cancel Order</h3>
		</div>
		<div class="box-body">
			<p>Are you sure you want to Cancel this order?!!</p>

			{{Form::open(['url'=>'/yproject/order/'.$order->id.'/cancel'])}}
			<div class="col-md-12">

				<div class="row">
					<div class="form-group">
						<label for="password" class="col-sm-2 control-label">Password</label>

						<div class="col-md-6">
							<input type="password" class="form-control" name="password" placeholder="password">
						</div>
					</div>
				</div>
				
				<div class="row">
					
					{{ Form::button('<i class="fa fa-check"></i> Yes' , ['class'=>'btn btn-danger pull-right' , 'type'=>'submit'])}}
					{{Form::close()}}
					<button class="btn btn-default" data-dismiss="modal"><i class="fa fa-times"></i> No</button>
				</div>
			</div>

		</div>
	</div>
</div>