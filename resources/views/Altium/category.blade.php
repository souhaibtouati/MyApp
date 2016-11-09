@extends('layouts.master')

@section ('head')
<!-- datatables -->
<link href="{{ asset("/plugins/datatables/dataTables.bootstrap.css") }}" rel="stylesheet" type="text/css" />
<!-- jQuery datatables -->
<script src="{{ asset("/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<!-- bootstrap datatables -->
<script src="{{ asset("/plugins/datatables/dataTables.bootstrap.min.js")}}"></script>

<style type="text/css">

	#datasheet, #footprint, #symbol {
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
				{!! Form::button('<i class="fa fa-list"></i> Show All ', ['class' => 'ShowAll-btn btn btn-primary', 'disabled'=>'true' , 'style'=> "margin-top: 5px;"]) !!}
				{!! Form::close() !!}
				{!! Form::button('<i class="fa fa-plus"></i> Create New ', ['class' => 'CreateNew-btn btn btn-success', 'onclick'=>'CreateNew()' , 'style'=> "margin-top: 5px;"]) !!}
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
					<i class="fa fa-plus"></i><h3 class="box-title"> Create New <span class="createType"></span></h3>
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
										<label class="btn btn-default" for="datasheet"><i class="fa fa-upload"></i>&nbsp&nbsp      Datasheet </label>
										<input type="file" name="datasheet" id="datasheet" />
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
				$(data).each(function(component){
					$('#show-all-table-body').append( '<tr><td>' +  data[component].Y_PartNr + '</td><td>' + data[component].Description  + '</td><td>' + data[component].Manufacturer + '</td><td>' + data[component].Manufacturer_Part_Number  +'</td><td>'+ data[component].Library_Ref +'</td><td><a href="/Altium/part/'+data[component].id+'/edit" class="btn btn-primary pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i></a></td></tr>' );
				});
				$('#create-new-div').hide("fade");
				$('#show-all-table').DataTable();
				$('#showall-div').show("fade");
			});
		});
	});
</script>

<script type="text/javascript">
	var myresults;
	var supp_Count = 1;
	function CreateNew(){
		$('#showall-div').hide("fade");
		$('#create-new-div').show("fade");
	}

	function ShowAll(){
		$('#create-new-div').hide("fade");
		$('#showall-div').show("fade");
		$('#showURL').submit(function(data){

		});
	}

	function Search(){

	}

	function OctoSearch(){
		$("#octo-table-body").html('');
		var url = "http://octopart.com/api/v3/parts/search";

		url += "?callback=?";
		url += "&apikey=a49294f9";

		var args = {
			q: $("#octo-keyword").val(),
			start: 0,
			limit: 10,
			'filter[queries][]' : 'offers.seller.name:Digi-Key offers.packaging:Cut-Tape',


		};

		$.getJSON(url, args, function(search_response) {

			myresults = search_response['results'];
			$.each(myresults, function(i,result){
				var Description = result.snippet;
				var manuf = result.item.manufacturer.name;
				var mpn = result.item.mpn;
				var offers = result.item.offers;
				var buff ="";
				$('#octo-table-body').append('<tr class="offers">\
					<td>'+ Description+ '</td>\
					<td>' + manuf + '</td>\
					<td>' + mpn + '</td>\
				</tr>\
				<tr class="offer">\
					<td id="offer_td'+i+'" colspan="5"></td></tr>'); 
							$.each(offers, function(j,offer){
								buff += '<tr><td>' + offer.seller.name + '</td><td>' + offer.sku + '</td><td>' + offer.in_stock_quantity + '</td><td><button class="btn btn-primary" onclick="addSupplier('+ i +','+ j +')"><i class="fa fa-plus"></i></button></td></tr>';
							});
							$('#offer_td'+ i).append('<table class="table table-hover"><thead><tr><th>Supplier</th><th>Supplier PN</th><th>Stock</th></tr></thead><tbody>' + buff + '</tbody></table>');
							buff = '';
							
						});


		}).done(function(){
			$('.table-expandable').each(function () {
				var table = $(this);
				table.children('thead').children('tr').append('<th></th>');
				table.children('tbody').children('tr').filter('.offer').hide();
				table.children('tbody').children('tr').filter('.offers').click(function () {
					var element = $(this);
					element.next('.offer').toggle('fast');
					element.find(".table-expandable-arrow").toggleClass("up");
				});
				table.children('tbody').children('tr').filter('.offers').each(function () {
					var element = $(this);
					element.append('<td><div class="table-expandable-arrow"></div></td>');
				});
			});

		});

	}


	function addSupplier(i , j){
		var supplier = myresults[i].item.offers[j].seller.name;
		var supplierPN =  myresults[i].item.offers[j].sku;
		if (supp_Count > 3) {
			$(".wrapper").overhang({
				type: "error",
				message: "You can only add up to 3 supplier links !!!"
				
			});
		}
		else if (1 < supp_Count && supp_Count <= 3) {
			$('#supply_chain').append(
				'<div class="row">	\
				<div class="col-xs-2">\
					<label for="Supplier_'+supp_Count+'">Supplier '+supp_Count+'</label>\
				</div>\
				<div class="col-xs-3">\
					<input type="text" id="Supplier_'+supp_Count+'" class="form-control" placeholder="Supplier '+supp_Count+'">\
				</div>\
				<div class="col-xs-2">\
					<label for="Supplier_Part_Number_'+supp_Count+'">Supplier PN '+supp_Count+'</label>\
				</div>\
				<div class="col-xs-3">\
					<input type="text" id="Supplier_Part_Number_'+supp_Count+'" class="form-control" placeholder="Supplier PN '+supp_Count+'">\
				</div>\
			</div>'
			);
			$('#Supplier_'+supp_Count+'').val(supplier);
			$('#Supplier_Part_Number_'+supp_Count+'').val(supplierPN);
			++supp_Count;
		}
		else if(supp_Count === 1){
			$('#Supplier_1').val(supplier);
			$('#Supplier_Part_Number_1').val(supplierPN);
			++supp_Count;
		}


	}

</script>


@endsection

