@extends('layouts.master')

@section ('head')
<!-- datatables -->
<link href="{{ asset("/plugins/datatables/dataTables.bootstrap.css") }}" rel="stylesheet" type="text/css" />
<!-- jQuery datatables -->
<script src="{{ asset("/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<!-- bootstrap datatables -->
<script src="{{ asset("/plugins/datatables/dataTables.bootstrap.min.js")}}"></script>
@endsection

@section('content')


<div class="row">
	<div class="col-md-12">
		<div class="box">
			<div class="box-body">
			<div class="col-md-3">
				<h1 style="margin-top: 0px"><i class="fa fa-cubes"></i> {{$Part->getName()}}</h1>
			</div>

			<div class="col-md-5">
				<div class="btn-group">
					@foreach($Part->getTables() as $Index => $Table)
					{!! Form::button(str_replace('_',' ',$Table), ['class' => 'btn-table btn btn-default','value'=>$Table]) !!}
					@endforeach
				</div>
			</div>
				<div class="col-md-4">
				<div class="btn-group pull-right">
					{!! Form::open(['url'=>'/Altium/'.$Part->getName().'/ShowAll', 'style'=>'display: inline']) !!}
					{!! Form::button('<i class="fa fa-list"></i> Show All ', ['class' => 'ShowAll-btn btn btn-primary', 'disabled'=>'true']) !!}
					{!! Form::close() !!}
					{!! Form::button('<i class="fa fa-plus"></i> Create New ', ['class' => 'CreateNew-btn btn btn-success', 'onclick'=>'CreateNew()']) !!}
					{!! Form::button('<i class="fa fa-search"></i> Search ', ['class' => 'Search-btn btn btn-warning', 'onclick'=>'Search()']) !!}
			
				</div>
				</div>

			</div>
		</div>
	</div>
</div>

<div class="row">
<div id="create-new-div" hidden>
	<div class="col-md-7">
		<div class="box box-success">
			<div class="box-header">
				<i class="fa fa-plus"></i><h3 class="box-title"> Create New <span class="createType"></span></h3>
			</div>
			<div class="box-body">

				{!! Form::model($Part, ['url'=>'/Altium/'.$Part->getName().'/store', 'id'=>'createURL']) !!}
				<input name="selected-Type" class="selected-Type" type="hidden" value= null>
				
				<div class="form-group">
				<h3>Altium Links</h3>
				<hr>
				<div class='row'>
					<div class="col-xs-3">
					<!-- {{ Form::label('Library Ref', 'Schematic Symbol') }} -->
					{{ Form::text('Library_Ref', null, ['placeholder' => 'Sch Symbol', 'class' => 'form-control']) }}
					</div>
					<div class="col-xs-3">
					<!-- {{ Form::label('Footprint Ref', 'Footprint') }} -->
					{{ Form::text('Footprint_Ref', null, ['placeholder' => 'Footprint', 'class' => 'form-control']) }}
					</div>
					<div class="col-xs-6">
					<!-- {{ Form::label('Description', 'Description') }} -->
					{{ Form::text('Description', null, ['placeholder' => 'Description', 'class' => 'form-control']) }}
					</div>
				</div>
				<h3>Manufacturer</h3>
				<hr>
				<div class='row'>	
					<div class="col-xs-3">
					<!-- {{ Form::label('Manufacturer', 'Manufacturer') }} -->
					{{ Form::text('Manufacturer', null, ['placeholder' => 'Manufacturer', 'class' => 'form-control']) }}
					</div>
					<div class="col-xs-3">
					<!-- {{ Form::label('Manufacturer Part Number', 'Manufacturer Part Number') }} -->
					{{ Form::text('Manufacturer_Part_Number', null, ['placeholder' => 'Manufacturer Part Number', 'class' => 'form-control']) }}
					</div>
				</div>
				<h3>Suppliers</h3>
				<hr>
				<div class='row'>	
					<div class="col-xs-3">
					<!-- {{ Form::label('Supplier 1', 'Supplier 1') }} -->
					{{ Form::text('Supplier_1', null, ['placeholder' => 'Supplier 1', 'class' => 'form-control']) }}
					</div>
					<div class="col-xs-3">
					<!-- {{ Form::label('Supplier 2', 'Supplier 2') }} -->
					{{ Form::text('Supplier_2', null, ['placeholder' => 'Supplier 2', 'class' => 'form-control']) }}
					</div>
					<div class="col-xs-3">
					<!-- {{ Form::label('Supplier 3', 'Supplier 3') }} -->
					{{ Form::text('Supplier_3', null, ['placeholder' => 'Supplier 3', 'class' => 'form-control']) }}
					</div>
				</div>
				<div class='row'>
					<div class="col-xs-3">
					<!-- {{ Form::label('Supplier Part Number 1', 'Supplier Part Number 1') }} -->
					{{ Form::text('Supplier_Part_Number_1', null, ['placeholder' => 'Supplier Part Number 1', 'class' => 'form-control']) }}
					</div>
					<div class="col-xs-3">
					<!-- {{ Form::label('Supplier Part Number 2', 'Supplier Part Number 2') }} -->
					{{ Form::text('Supplier_Part_Number_2', null, ['placeholder' => 'Supplier Part Number 2', 'class' => 'form-control']) }}
					</div>
					<div class="col-xs-3">
					<!-- {{ Form::label('Supplier Part Number 3', 'Supplier Part Number 3') }} -->
					{{ Form::text('Supplier_Part_Number_3', null, ['placeholder' => 'Supplier Part Number 3', 'class' => 'form-control']) }}
					</div>
				</div>
				
				<h3>Parameters</h3>
				<hr>
				<div class="row">
					<div id="parameters-div">
						@foreach( $Part->getChildFill() as $child)
							<div class="col-xs-3">
							{{ Form::text($child, null, ['placeholder' => $child, 'class' => 'form-control']) }}
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

		<div class="col-md-5">
		<div class="box box-success">
			<div class="box-header">
				<i class="fa fa-server"></i><h3 class="box-title"> Live Data Search</h3>
			</div>
			<div class="box-body">
				<p>Octopart</p>
			</div>			
		</div>
	</div>

</div>
<!-- Create New Div-->

<div id="showall-div" hidden="true">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<i class="fa fa-list"></i><h3 class="box-title"> Show All <span class="createType"></span></h3>
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
				</thead>
				<tbody id="show-all-table-body">
					
				</tbody>
			</table>
			</div>
		</div>
	</div>
</div>
<!-- Show All Div-->

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

		$('input[name=Manufacturer_Part_Number]').focusout(function(){
			alert('searching for Manufacturer...');
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
					$(data).each(function(component){
						$('#show-all-table-body').append( '<tr><td>' +  data[component].Y_PartNr + '</td><td>' + data[component].Description  + '</td><td>' + data[component].Manufacturer + '</td><td>' + data[component].Manufacturer_Part_Number  +'</td></tr>' );
					});
					$('#create-new-div').hide("fade");
					$('#show-all-table').DataTable();
					$('#showall-div').show("fade");
				});
			});
		});
</script>

<script type="text/javascript">
	function CreateNew(){
		$('#showall-div').hide("fade");
		$('#create-new-div').show("fade");
	}

	function ShowAll(){
		$('#create-new-div').hide("fade");
		$('#showall-div').show("fade");
		$('#showURL').submit(function(data){
			console.log(data);
		});
	}

	function Search(){

	}


</script>


@endsection
