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
	}

</style>
@endsection



@section('content')


<div class="row">
	<div class="col-md-12">

		
		<div class="col-md-2">
			<h1 style="margin-top: 0px"><i class="fa fa-cubes"></i><b> {{$Part->getName()}}</b></h1>
		</div>

		<div class="col-md-5">
			<div class="btn-group">
				@foreach($Part->getTables() as $Index => $Table)
				{!! Form::button(str_replace('_',' ',strtoupper($Table)), ['class' => 'btn-table btn btn-default','value'=>$Table, 'style'=>'background-color: white; margin-top: 5px']) !!}
				@endforeach
			</div>
		</div>
		<div class="col-md-4">
			<div class="btn-group pull-right">
				{!! Form::open(['url'=>'/Altium/'.$Part->getName().'/ShowAll', 'style'=>'display: inline']) !!}
				{!! Form::button('<i class="fa fa-list"></i> List view ', ['class' => 'ShowAll-btn btn btn-primary', 'disabled'=>'true' , 'style'=> "margin-top: 5px;"]) !!}
				{!! Form::close() !!}
				{!! Form::button('<i class="fa fa-plus"></i> New '.$Part->getName(), ['class' => 'CreateNew-btn btn btn-success', 'onclick'=>'CreateNew()' , 'style'=> "margin-top: 5px;"]) !!}
				{!! Form::button('<i class="fa fa-search"></i> Search ', ['class' => 'Search-btn btn btn-warning', 'onclick'=>'Search()' , 'style'=> "margin-top: 5px;"]) !!}

			</div>
		</div>

		
		
	</div>
</div>

<div class="row">
	<div id="create-new-div" {{ Session::get('showDiv') === 'create' ? '' : 'hidden="true"' }}>
		<div class="col-md-6">
			{!! Form::model($Part, ['url'=>'/Altium/'.$Part->getName().'/store', 'id'=>'createURL', 'enctype'=>'multipart/form-data']) !!}
			<input name="selected-Type" class="selected-Type" type="hidden" value= null>
			<div class="box box-success">
				<div class="box-header">
					<i class="fa fa-plus"></i><h3 class="box-title"> Create New <span class="createType" style="color: red"></span></h3>
				</div>
				<div class="box-body">
					

					<div class="form-group">
						<table class="table">
							<thead>
								<tr>
									<th style="text-align: center"><img src="/img/symbol.png" style="width: 110px"></th>
									<th style="text-align: center"><img src="/img/footprint.png" style="width: 100px"></th>
									<th style="text-align: center"><img src="/img/datasheet.png" style="width: 80px"></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="text-align: center">
										<label class="btn btn-default" for="symbol"><i class="fa fa-upload"></i>&nbsp&nbsp      Symbol </label>
										<input type="file" name="symbol" id="symbol" />
									</td>
									<td style="text-align: center">
										<label class="btn btn-default" for="footprint"><i class="fa fa-upload"></i>&nbsp&nbsp      Footprint </label>
										<input type="file" name="footprint" id="footprint" />
									</td>
									<td style="text-align: center">
										<label class="btn btn-default" for="ComponentLink1URL"><i class="fa fa-upload"></i>&nbsp&nbsp      Datasheet </label>
										<input type="file" name="ComponentLink1URL" id="ComponentLink1URL" />
									</td>
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
							<div class="col-xs-3 pull-right">
								{{ Form::button('<i class="fa fa-save"></i> Save' , ['class'=>'btn btn-success ', 'type'=>'submit', 'disabled'=>'true', 'id'=>'CreateButton'])}}
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
</div>
<!-- Create New Div-->

<div id="showall-div" {{ Session::get('showDiv') === 'showall' ? '' : 'hidden="true"' }} >
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<i class="fa fa-list"></i><h3 class="box-title"> Library <span class="createType"></span></h3>
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
						<th></th>
					</thead>
					<tbody id="show-all-table-body">

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- Show All Div-->


<div id="SearchDiv" hidden="true">
<div class="col-md-12">	
		<div class="box box-warning">
		<div class="box-header">
			<i class="fa fa-search"></i><h3 class="box-title"> Find <span class="createType"></span></h3>
		</div>

		<div class="box-body">
		<div class="form-group">
			{{Form::open(['url' =>'Altium/'.$Part->getName().'/search'])}}
			<input name="selected-Type-show" class="selected-Type" type="hidden" value= null>
			<div class="col-md-2">
			{{Form::label('SearchBy','Search By')}}
			</div>
			<div class="col-md-3">
			{{Form::select('SearchBy',['MPN'=>'Manufacturer PN','SKU'=>'Supplier PN', 'keyword'=>'keyword'],null,['class'=>'form-control'])}}
			</div>
			<div class="col-md-3">
			{{Form::text('SearchKeyword',null,['placeholder'=>'Search Keyword', 'class'=>'form-control'])}}
			</div>
			<div class="col-md-3">
			{{ Form::button('<i class="fa fa-search"></i>' , ['class'=>'SearchBtn btn btn-warning'])}}	
			</div>
			
			{{Form::close()}}
		</div>
		</div>
			
		</div>
</div>	
</div>

</div>
<!-- Content Row -->
@endsection

@section ('footer')

<script type="text/javascript">
	$(document).ready(function(){
		$('.btn-table').click(function(){
			$('#CreateButton').prop('disabled', false);
			$(".ShowAll-btn").attr('disabled',false);
			$('.createType').text($(this).text());
			$('.selected-Type').val($(this).val());

		});
	});
</script>

<script type="text/javascript">
	$(document).ready(function(){

		$('.ShowAll-btn').click(function(){
			var	token = $('input[name=_token]').val();
			var table = $('.selected-Type').val();
			$.ajax({
				url: window.location.href + '/ShowAll',
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				data: {table : table}
			}).success(function(data){
				$('#show-all-table-body').empty();
				$('#show-all-table-body').append(data);

				$('#create-new-div').hide("fade");
				$('#show-all-table').DataTable();
				$('#showall-div').show("fade");
			});
		});

		$('.SearchBtn').click(function(){
			var	token = $('input[name=_token]').val();
			var table = $('.selected-Type').val();
			var SearchBy = $('select[name=SearchBy]').val();
			var keyword = $('input[name=SearchKeyword]').val();
			$.ajax({
				url: window.location.href + '/search',
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				data: {table: table, SearchBy : SearchBy, keyword : keyword}
			}).success(function(data){
				console.log(data);
			});
		});

	});
</script>

<script type="text/javascript" src="{{asset('js/OctoSearch.js')}}"></script>

<script type="text/javascript">

	function CreateNew(){
		$('#showall-div').hide();
		$('#SearchDiv').hide();
		$('#create-new-div').show("fade");
	}

	function ShowAll(){
		$('#create-new-div').hide();
		$('#SearchDiv').hide();
		$('#showall-div').show("fade");
		$('#showURL').submit(function(data){

		});
	}

	function Search(){
		$('#showall-div').hide();
		$('#create-new-div').hide();
		$('#SearchDiv').show('fade');
	}
</script>


@endsection

