@extends('layouts.master')	

@section('head')
<style type="text/css">

	table.table-expandable > tbody > tr:nth-child(odd) {
		cursor: pointer;
	}

	table.table-expandable.table-hover > tbody > tr:nth-child(even):hover td {
		background-color: white;
	}

	table.table-expandable > tbody > tr div.table-expandable-arrow {
		background:transparent url(/img/arrows.png) no-repeat scroll 0px -16px; width:16px; height:16px; display:block;
	}

	table.table-expandable > tbody > tr div.table-expandable-arrow.up {
		background-position:0px 0px;
	}

</style>
@endsection

@section('content')
<h1 style="margin-top: 0px"><i class="fa fa-edit"></i> <b>{{$part->Y_PartNr}}</b></h1>
	<div id="Edit-div" class="col-md-6">

	<div class="box box-success">
		<div class="box-header">
			<i class="fa fa-archive"></i><h3 class="box-title"> Altium Links <span class="createType"></span></h3>
		</div>
		<div class="box-body">
			{!! Form::model($part, ['url'=>'/Altium/'.$part->getName(). '/'. $part->getTable() .'/'. $part->id .'/update', 'id'=>'EditURL', 'method'=>'UPDATE']) !!}
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
							{{ Form::label($child, str_replace('_' , ' ', $child))}}
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

		<div class="col-md-6">
			<div class="box box-success">
				<div class="box-header">
					<i class="fa fa-server"></i><h3 class="box-title"> Live Data Search</h3>
				</div>
				<div class="box-body" style="overflow: auto;">
					<img src="/img/Octopart_logo.png" class="pull-right" style="width: 150px">
					<div class="col-xs-5">
						<input id="octo-keyword" class="form-control" placeholder="Search Keyword" >
					</div>
					<div class="col-xs-2">
						<button class="btn btn-primary" onclick="OctoSearch()">Go</button>
					</div>
					
					
					<br><br><br>

					<table class="table table-expandable" id="octo-table" width="100%">
						<thead>
							<tr>
								<th>Description</th>
								<th>Manufacturer</th>
								<th>MPN</th>
							</tr>
						</thead>
						<tbody id="octo-table-body">

						</tbody>
					</table>
					

</div>			
</div>
</div>


<script type="text/javascript" src="{{asset('js/OctoSearch.js')}}"></script>

@endsection