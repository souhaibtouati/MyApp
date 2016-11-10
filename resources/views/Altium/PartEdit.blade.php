@extends('layouts.master')	

@section('content')

<div id="Edit-div" class="col-md-8">
	{!! Form::model($part, ['url'=>'/Altium/'.$part->getName().'/update', 'id'=>'EditURL', 'onsubmit'=>'getclass(this);']) !!}
	<input name="sub" type="hidden" value= "{{$part->getTable()}}" >
	<div class="box box-success">
		<div class="box-header">
			<i class="fa fa-pencil"></i><h3 class="box-title"> Edit <span class="createType"></span></h3>
		</div>
		<div class="box-body">
			<div class="form-group">
				<div class="row">
					<div class="col-md-3">
						{{ Form::label('Library_Ref', 'Symbol') }}
						{{ Form::text('Library_Ref', null, ['placeholder' => 'Symbol', 'class' => 'form-control']) }}
					</div>
					<div class="col-md-3">
						{{ Form::label('Footprint_Ref', 'Footprint') }}
						{{ Form::text('Footprint_Ref', null, ['placeholder' => 'Footprint', 'class' => 'form-control']) }}
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						{{ Form::label('ComponentLink1URL', 'Datasheet Path') }}
						{{ Form::text('ComponentLink1URL', null, ['placeholder' => 'Datasheet', 'class' => 'form-control']) }}
					</div>
				</div>
				<div class='row'>
					<div class="col-md-12">
						{{ Form::label('Description', 'Description') }}
						{{ Form::text('Description', null, ['placeholder' => 'Description', 'class' => 'form-control']) }}
					</div>
				</div>
			</div>

		</div>
	</div>


	<div class="box box-success">
		<div class="box-header">
			<i class="fa fa-plus"></i><h3 class="box-title"> Supply Chain</h3>
		</div>
		<div class="box-body">
			<div class="form-group" id="supply_chain">
				<div class='row'>	
					<div class="col-xs-2">
						{{ Form::label('Manufacturer', 'Manufacturer') }}
					</div>
					<div class="col-xs-3">
						{{ Form::text('Manufacturer', null, ['placeholder' => 'Manufacturer', 'class' => 'form-control']) }}
					</div>

					<div class="col-xs-2">
						{{ Form::label('Manufacturer Part Number', 'Manufacturer PN') }}
					</div>
					<div class="col-xs-3">
						{{ Form::text('Manufacturer_Part_Number', null, ['placeholder' => 'Manufacturer Part Number', 'class' => 'form-control']) }}
					</div>
				</div>

				<div class='row'>	
					<div class="col-xs-2">
						{{ Form::label('Supplier_1', 'Supplier 1') }}
					</div>
					<div class="col-xs-3">
						{{ Form::text('Supplier_1', null, ['placeholder' => 'Supplier 1', 'class' => 'form-control']) }}
					</div>

					<div class="col-xs-2">
						{{ Form::label('Supplier_Part_Number_1', 'Supplier PN 1') }}
					</div>
					<div class="col-xs-3">
						{{ Form::text('Supplier_Part_Number_1', null, ['placeholder' => 'Supplier Part Number 1', 'class' => 'form-control']) }}
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="box box-success">
		<div class="box-header">
			<i class="fa fa-plus"></i><h3 class="box-title"> Parameters</h3>
		</div>
		<div class="box-body">

			<div class="form-group">
				<div class="row">
					<div id="parameters-div">
						@foreach( $part->getChildFill() as $child)
						<div class="col-xs-3">
							{{ Form::text($child, null, ['placeholder' => $child, 'class' => 'form-control']) }}
						</div>
						@endforeach
					</div>
				</div>
				<div class='row'>
					<br>
					<div class="col-xs-3 pull-right">
					{{ Form::button('<i class="fa fa-save"></i> Save' , ['class'=>'btn btn-success ', 'type'=>'submit',  'id'=>'EditButton'])}}
					</div>
				</div>	
			</div>
			{{ Form::close()}}
		</div>			
	</div>

</div>


@endsection