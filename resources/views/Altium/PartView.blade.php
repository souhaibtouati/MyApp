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
						<div class="col-xs-3">
						<label>Package</label>
						<span class="pull-right" style="color: #99004C">{{ $part->Package}}</span>
						</div>
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

			<div class="box box-info">
		<div class="box-header">
			<i class="fa fa-database"></i><h3 class="box-title"> Database History <span class="createType"></span></h3>
		</div>
		<div class="box-body">
			<table class="table">
				<tbody>
					<tr><th>Revision</th><td>{{$part->Revision}}</td></tr>
					<tr><th>Created at</th><td>{{$part->created_at}}</td></tr>
					<tr><th>Updated By</th><td>{{$part->modified_by}}</td></tr>
					<tr><th>Updated at</th><td>{{$part->updated_at}}</td></tr>
				</tbody>
			</table>
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
		<table class="table">
			<tr>Symbol History</tr>
			<tbody>
			@foreach($sym_log as $Sym)
				<tr>
				<td> 
					<th>Revision</th><td>{{$Sym->getRevision()}}</td>
					<th>Author</th><td>{{$Sym->getAuthor()}}</td>
					<th>Date</th><td>{{$Sym->getDate()->format('d-m-Y H:i')}}</td>
					<th>Message</th><td>{{$Sym->getMessage()}}</td>
				</td> 
				</tr>
				@endforeach
			</tbody>
		</table>
		</div>

		<div class="col-md-6">
		<table class="table">
				<tr>Footprint History</tr>
			<tbody>
			@foreach($ftpt_log as $ftpt)
				<tr>
				<td> 
					<th>Revision</th><td>{{$ftpt->getRevision()}}</td>
					<th>Author</th><td>{{$ftpt->getAuthor()}}</td>
					<th>Date</th><td>{{$ftpt->getDate()->format('d-m-Y H:i')}}</td>
					<th>Message</th><td>{{$ftpt->getMessage()}}</td>
				</td> 
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