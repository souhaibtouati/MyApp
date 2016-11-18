@extends('layouts.master')

@section('head')

<style type="text/css">
	td {color: #99004C}
</style>

@endsection

@section('content')

<h1 style="margin-top: 0px"><i class="fa fa-eye"></i> <b>{{$part->Y_PartNr}}</b></h1>

<div id="View-div" class="col-md-6">

	<div class="box box-info">
		<div class="box-header">
			<i class="fa fa-archive"></i><h3 class="box-title"> Altium Links <span class="createType"></span></h3>
		</div>
		<div class="box-body">
			<table class="table table-condensed">
				<tbody>
					<tr><th>Part Number</th><td>{{$part->Y_PartNr}}</td></tr>
					<tr><th>Description</th><td>{{$part->Description}}</td></tr>
					<tr><th>Symbol Ref</th><td>{{$part->Library_Ref}}</td></tr>
					<tr><th>Footprint Ref</th><td>{{$part->Footprint_Ref}}</td></tr>
					<tr><th>Datasheet Path</th><td>{{$part->ComponentLink1URL}}<a class="btn pull-right" href="{{$part->ComponentLink1URL}}"><i class="fa fa-external-link"></i></a></td></tr>
				</tbody>
			</table>
		</div>
	</div>

	<div class="box box-info">
		<div class="box-header">
			<i class="fa fa-truck"></i><h3 class="box-title"> Supply Chain <span class="createType"></span></h3>
		</div>
		<div class="box-body">
			<table class="table">
				<tbody>
					<tr><th>Manufacturer</th><td>{{$part->Manufacturer}}</td><th>Manufacturer PN</th><td id="mpn">{{$part->Manufacturer_Part_Number}}</td></tr>

					@if($part->Supplier_Part_Number_1 !== null)
					<tr><th>Supplier 1</th><td>{{$part->Supplier_1}}</td><th>Supplier 1 PN</th><td>{{$part->Supplier_Part_Number_1}}</td></tr>
					@endif

					@if($part->Supplier_Part_Number_2 !== null)
					<tr><th>Supplier 2</th><td>{{$part->Supplier_2}}</td><th>Supplier 2 PN</th><td>{{$part->Supplier_Part_Number_2}}</td></tr>
					@endif

					@if($part->Supplier_Part_Number_3 !== null)
					<tr><th>Supplier 3</th><td>{{$part->Supplier_3}}</td><th>Supplier 3 PN</th><td>{{$part->Supplier_Part_Number_3}}</td></tr>
					@endif

				</tbody>
			</table>
		</div>
	</div>

		<div class="box box-info">
		<div class="box-header">
			<i class="fa fa-tags"></i><h3 class="box-title"> Parameters</h3>
		</div>
		<div class="box-body">
				<div class="row">
					<div id="parameters-div">
						@foreach( $part->getChildFill() as $child)
						<div class="col-xs-3">
						<label>{{str_replace('_' , ' ', $child)}}</label>
						<span class="pull-right" style="color: #99004C">{{ $part->$child}}</span>
						</div>
						@endforeach
					</div>
				</div> 
		</div>			
	</div>

</div>

<div class="col-md-6">
	<div class="box box-success">
		<div class="box-header">
			<i class="fa fa-globe"></i><h3 class="box-title"> Live Specs</h3>
		</div>
		<div class="box-body" id="specsdiv">
		<img id="PartPic" style="display: block;  width:auto;" class="pull-left">
		</div>
		</div>
</div>


<div class="col-md-12">
	<div class="box box-warning">
		<div class="box-header">
			<i class="fa fa-cloud-upload"></i><h3 class="box-title"> Repository Infos</h3>
		</div>
		<div class="box-body">
		<div class="col-md-6">
		<table class="table col-md-6">
		<thead style="text-align: center">
				<th>Symbol</th>
		</thead>
			<tbody>
			@foreach($sym_log as $Sym)
				<tr>
				<td> <!-- Symbol td -->
					<th>Revision</th><td>{{$Sym->getCommit()->getRevision()}}</td>
					<th>Updated By</th><td>{{$Sym->getCommit()->getAuthor()}}</td>
					<th>Message</th><td>{{$Sym->getCommit()->getMessage()}}</td>
				</td> <!-- Symbol td -->
				</tr>
				@endforeach
			</tbody>
		</table>
		</div>

		<div class="col-md-6">
		<table class="table">
		<thead style="text-align: center">
				<th>Footprint</th>
		</thead>
			<tbody>
			@foreach($ftpt_log as $ftpt)
				<tr>
				<td> <!-- Symbol td -->
					<th>Revision</th><td>{{$ftpt->getCommit()->getRevision()}}</td>
					<th>Updated By</th><td>{{$ftpt->getCommit()->getAuthor()}}</td>
					<th>Message</th><td>{{$ftpt->getCommit()->getMessage()}}</td>
				</td> <!-- Symbol td -->
				</tr>
				@endforeach
			</tbody>
		</table>
		</div>
		
		</div>
</div>
</div>


<script type="text/javascript" src="{{asset('js/OctoSearch.js')}}"></script>
<script type="text/javascript">
	$(document).ready(function(){
		getpartspecs();
	});
</script>

@endsection