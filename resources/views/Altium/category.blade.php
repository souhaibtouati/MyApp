@extends('layouts.master')

@section ('head')
<!-- datatables -->
<link href="{{ asset("/plugins/datatables/dataTables.bootstrap.css") }}" rel="stylesheet" type="text/css" />
<!-- jQuery datatables -->
<script src="{{ asset("/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<!-- bootstrap datatables -->
<script src="{{ asset("/plugins/datatables/dataTables.bootstrap.min.js")}}"></script>

<style type="text/css">

	#ComponentLink1URL, #footprint, #symbol {
		opacity: 0;
		position: absolute;
		z-index: -1;
	}    


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

		.bigdrop {
			width: 250px !important;
		}
	}

</style>
@endsection

@section('content-header')
<h1><i class="fa fa-cubes"></i><b> {{$Part->getName()}}</b></h1>
@endsection

@section('content')


<div class="row">

	<div class="col-md-6 col-sm12">

		<div class="btn-group pull-left">
			@foreach($Part->getTables() as $Index => $Table)
			{!! Form::button('<i class="fa fa-cube"></i> '.str_replace('_',' ',strtoupper($Table)), ['class' => 'btn-table btn btn-default','value'=>$Table, 'style'=>'background-color: white; color: DarkBlue;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);']) !!}
			@endforeach
		</div>
	</div>
	<div class="col-lg-6 col-sm12">

		<div class="btn-group pull-right" style="display: inline;">

			<button class="btn btn-primary" onclick="ShowAll()"><i class="fa fa-list"></i> Lib view</button>
			<button class="CreateNew-btn btn btn-success" onclick="CreateNew()"><i class="fa fa-plus"></i> New {{$Part->getName()}}</button>	
			<button class="Search-btn btn btn-warning" onclick="Search()"><i class="fa fa-search"></i> Search</button>	


		</div>
	</div>

</div> <!-- Row -->
<div class="row">
	<div id="create-new-div" {{ Session::get('showDiv') === 'create' ? '' : 'hidden="true"' }}>
		<div class="col-md-6">
			{!! Form::model($Part, ['url'=>'/Altium/'.$Part->getName().'/store', 'id'=>'createURL', 'enctype'=>'multipart/form-data']) !!}
			<input name="selected-Type" class="selected-Type" style="display: none" value= null>
			<div class="box box-success">
				<div class="box-header">
					<i class="fa fa-plus"></i><h3 class="box-title"> Create New <span class="createType" style="color: red"></span></h3>
				</div>
				<div class="box-body">
					

					<div class="form-group">
						<table class="table">
							<tbody>
								<tr>
									<td style="text-align: center">
										<span>New</span>
										<input type="radio" name="SymType" value="New" checked="true">
										<input type="radio" name="SymType" value="Existing">
										<span>Existing</span>
									</td>
									<td style="text-align: center">
										<span>New</span>
										<input type="radio" name="FTPTType" value="New" checked="true">
										<input type="radio" name="FTPTType" value="Existing">
										<span>Existing</span>
									</td>
									<td style="text-align: center">
										<span>New</span>
										<input type="radio" name="DSType" value="New" checked="true">
										<input type="radio" name="DSType" value="Existing">
										<span>Existing</span>
									</td>
								</tr>
								<tr>
									<th style="text-align: center"><img src="/img/symbol.png" style="width: 110px"></th>
									<th style="text-align: center"><img src="/img/footprint.png" style="width: 100px"></th>
									<th style="text-align: center"><img src="/img/datasheet.png" style="width: 80px"></th>
								</tr>


								<tr>
									<td style="text-align: center">
										<label class="btn btn-default" for="symbol" id="symbolLabel"><i class="fa fa-upload"></i>&nbsp&nbsp      Symbol </label>
										<input type="file" name="symbol" id="symbol" />

										<div id="symbol-select-div" style="display: none; width: 100%">
											<select class="form-control" name="symbol-select" id="symbol-select" style="width: 100%">
												<option>Select Symbol</option>
											</select>
										</div>
									</td>
									<td style="text-align: center">
										<label class="btn btn-default" for="footprint" id="footprintLabel"><i class="fa fa-upload"></i>&nbsp&nbsp      Footprint </label>
										<input type="file" name="footprint" id="footprint" />

										<div id="footprint-select-div" style="display: none">
											<select class="form-control" name="footprint-select" id="footprint-select" style="width: 100%">
												<option>Select Footprint</option>
											</select>
										</div>
									</td>
									<td style="text-align: center; max-width: 200px;">
										<label class="btn btn-default" for="ComponentLink1URL" id="DatasheetLabel"><i class="fa fa-upload"></i>&nbsp&nbsp      Datasheet </label>
										<input type="file" name="ComponentLink1URL" id="ComponentLink1URL" />

										<div id="Datasheet-select-div" style="display: none">
											<select class="form-control" name="Datasheet-select" id="Datasheet-select" style="width: 100%;">
												<option>Select Datasheet</option>
											</select>
										</div>
									</td>
								</tr>
								<tr>
									<td style="text-align: center;" id="SymFname"></td>
									<td style="text-align: center;" id="ftptFname"></td>
									<td style="text-align: center;" id="dsFname"></td>
								</tr>
							</tbody>
						</table>

					</div>

					<div class="form-group">
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
								{{ Form::text('Manufacturer', null, ['placeholder' => 'Manufacturer', 'class' => 'form-control', 'id'=>'Manufacturer']) }}
							</div>

							<div class="col-xs-2">
								{{ Form::label('Manufacturer Part Number', 'Manufacturer PN') }}
							</div>
							<div class="col-xs-3">
								{{ Form::text('Manufacturer Part Number', null, ['placeholder' => 'Manufacturer Part Number', 'class' => 'form-control', 'id'=>'Manufacturer_Part_Number']) }}
							</div>
							<button class="btn btn-flat" onclick="getpartspecs();" type="button">Specs &nbsp<i class="fa fa-arrow-circle-right"></i></button>
						</div>

						<div class='row'>	
							<div class="col-xs-2">
								{{ Form::label('Supplier 1', 'Supplier 1') }}
							</div>
							<div class="col-xs-3">
								{{ Form::text('Supplier 1', null, ['id'=>'Supplier_1', 'placeholder' => 'Supplier 1', 'class' => 'form-control']) }}
							</div>

							<div class="col-xs-2">
								{{ Form::label('Supplier Part Number 1', 'Supplier PN 1') }}
							</div>
							<div class="col-xs-3">
								{{ Form::text('Supplier Part Number 1', null, ['id'=>'Supplier_Part_Number_1', 'placeholder' => 'Supplier Part Number 1', 'class' => 'form-control']) }}
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
								<div class="col-xs-3">
									{{ Form::label('Package', 'Package')}}
									{{ Form::text('Package', null, ['placeholder' => 'Package', 'class' => 'form-control']) }}
								</div>
								@foreach( $Part->getChildFill() as $child)
								<div class="col-xs-3">
									{{ Form::label($child, str_replace('_', ' ', $child))}}
									{{ Form::text($child, null, ['placeholder' => str_replace('_', ' ', $child), 'class' => 'form-control']) }}
								</div>
								@endforeach
							</div>
						</div>
						<div class='row'>
							<br>
							<div class="col-xs-12" style="margin: auto; text-align: center">
								{{ Form::button('<i class="fa fa-save"></i> Save' , ['class'=>'btn btn-lg btn-success ', 'type'=>'submit', 'disabled'=>'true', 'id'=>'CreateButton', 'style'=>'width:30%'])}}
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
						<button class="btn btn-primary" id="octoBtn" onclick="OctoSearch()">Go</button>
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

			<div class="box box-success">
				<div class="box-header">
					<i class="fa fa-globe"></i><h3 class="box-title"> Live Specs</h3>
				</div>
				<div class="box-body" id="specsdiv">
					<img id="PartPic" style="display: block;  width:auto;" class="pull-left">
				</div>
			</div>
		</div>
	</div>
	<!-- Create New Div-->
	
	<div id="showall-div" {{ Session::get('showDiv') === 'showall' ? '' : 'hidden="true"' }} >
		<div class="col-md-12">
			<div class="box box-primary">
				<div class="box-header">
					<i class="fa fa-list"></i><h3 class="box-title"> Library <span class="createType" style="color: red"></span></h3>
					<button class="ShowAll-btn btn btn-primary pull-right"><i class="fa fa-refresh"></i>&nbsp Refresh</button>
				</div>
				<div class="box-body">
					{!! Form::open(['url'=>'/Altium/'.$Part->getName().'/ShowAll', 'id'=>'showURL']) !!}
					<input name="selected-Type-show" class="selected-Type" type="hidden" value= null>
					{!! Form::close() !!}
					<table class="table table-hover" id="show-all-table">
						<thead>
							<th>Part Nbr</th>
							<th>Description</th>
							<th>Manufacturer</th>
							<th>MPN</th>
							<th>Symbol</th>
							<th>Footprint</th>
							<th></th>
						</thead>
						<tbody id="show-all-table-body">

						</tbody>
					</table>
				</div>
			</div>
		</div>

		<!-- Modal Dialog -->
		<div class="modal modal-danger fade" id="confirmDeletePart" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
			<div class="modal-dialog">
				{{ Form::open(['url' => '/Altium/delete']) }}
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title">Delete Parmanently</h4>
					</div>
					<div class="modal-body">
						<p>Are you sure you want to delete this component from Database ?</p>

						<input type="text" name="dl-type" id="dl-type" style="display: none">
						<input type="text" name="dl-table" id="dl-table" style="display: none">
						<input type="text" name="dl-id" id="dl-id" style="display: none">


					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						{{ Form::button('Delete' , ['class'=>'btn btn-danger ', 'type'=>'submit'])}}

					</div>

				</div>
			</div>
			{{ Form::close()}}
		</div>
	</div>
	<!-- Show All Div-->
	
	
	<div id="SearchDiv" hidden="true">
		<div class="col-md-12">	
			<div class="box box-warning">
				<div class="box-header">
					<i class="fa fa-search"></i><h3 class="box-title"> Find <span class="createType" style="color: red"></span></h3>
				</div>

				<div class="box-body">
					<div class="form-group">

						<input name="selected-Type-show" class="selected-Type" type="hidden" value= null>
						<div class="col-md-2">
							{{Form::label('SearchBy','Search By')}}
						</div>
						<div class="col-md-3">
							{{Form::select('SearchBy',['MPN'=>'Manufacturer PN','SKU'=>'Supplier PN', 'Description'=>'Description'],null,['class'=>'form-control'])}}
						</div>
						<div class="col-md-3">
							{{Form::text('SearchKeyword',null,['placeholder'=>'Search Keyword', 'class'=>'form-control'])}}
						</div>
						<div class="col-md-3">
							{{ Form::button('<i class="fa fa-search"></i>' , ['class'=>'SearchBtn btn btn-warning'])}}	
						</div>


					</div>
				</div>
			</div>
			<div class="box box-warning" id="searchResultDiv" hidden="true">
				<div class="box-header">
					<i class="fa fa-list"></i><h3 class="box-title"> Results </h3>
				</div>
				<div class="box-body">
					<table class="table table-hover" id="search-result-table">
						<thead>
							<th>Part Nbr</th>
							<th>Description</th>
							<th>Manufacturer</th>
							<th>MPN</th>
							<th>Symbol</th>
							<th>Footprint</th>
							<th></th>
						</thead>
						<tbody id="search-result-table-body">

						</tbody>
					</table>
				</div>
			</div>	


		</div>	
	</div>
</div>


<!-- Please wait -->
<div id="waitModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content" style="margin-top: 30%">
			<div class="modal-body">
				<div class="box-body">


					<img src="{{asset('img/wait.gif')}}" style="margin-left: 30%">

					<img src="{{asset('img/wait2.gif')}}" style="width: 90%">
					
				</div>

			</div>

		</div>
	</div>

</div>


@endsection

@section ('footer')

<script src="{{ asset ('/js/Altium.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('js/OctoSearch.js')}}"></script>

@endsection

