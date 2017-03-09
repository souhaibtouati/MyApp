@extends('layouts.master')

@section('head')

<style type="text/css">
	
	.loader {
    position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 150px;
  height: 150px;
  margin: -75px 0 0 -75px;
  border: 16px solid #f3f3f3;
  border-radius: 50%;
  border-top: 16px solid #3498db;
  width: 120px;
  height: 120px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

</style>

@endsection

@section('content-header')
<h1><i class="fa fa-eye"></i> <b>{{$part->Y_PartNr}}</b> Details <button class="btn btn-primary pull-right" data-toggle="modal" data-target="#SVN_Modal" onclick="getSVNdata('{{$part->getname()}}','{{$part->getLibRef()}}','{{$part->getFtptRef()}}')"><i class="fa fa-globe"></i>&nbsp SVN Info</button></h1>
@endsection

@section('content')



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
					<tr><th>Symbol Ref</th><td>{{$part['Library Ref']}}</td></tr>
					<tr><th>Footprint Ref</th><td>{{$part['Footprint Ref']}}</td></tr>
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
					<tr>
						<th>Manufacturer</th><td>{{$part->Manufacturer}}</td>
						<th>Manufacturer PN</th><td id="mpn">{{$part['Manufacturer Part Number']}}</td></tr>

						@if($part['Supplier Part Number 1'] !== null)
						<tr><th>Supplier 1</th><td>{{$part['Supplier 1']}}</td><th>Supplier 1 PN</th><td>{{$part['Supplier Part Number 1']}}</td></tr>
						@endif

						@if($part['Supplier Part Number 2'] !== null)
						<tr><th>Supplier 2</th><td>{{$part['Supplier 2']}}</td><th>Supplier 2 PN</th><td>{{$part['Supplier Part Number 2']}}</td></tr>
						@endif

						@if($part['Supplier Part Number 3'] !== null)
						<tr><th>Supplier 3</th><td>{{$part['Supplier 3']}}</td><th>Supplier 3 PN</th><td>{{$part['Supplier Part Number 3']}}</td></tr>
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
							<span class="pull-right" >{{ $part->Package}}</span>
						</div>
						@foreach( $part->getChildFill() as $child)
						<div class="col-xs-3">
							<label>{{str_replace('_' , ' ', $child)}}</label>
							<span class="pull-right" >{{ $part->$child}}</span>
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

	<!-- SVN Modal -->
	<div id="SVN_Modal" class="modal fade" role="dialog" style="background-color: transparent;">
		<div class="modal-dialog">
	<div class="loader" id="loader"></div>
			<!-- Modal content-->
			<div class="modal-content">
				<div class="modal-body" style="padding: 0 !important;">
				<div class="modal-header" style="background-color: #FFE5CC">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title"><i class="fa fa-microchip"></i> Symbol History</h4>
				</div>
					<div class="col-md-12">
						<table class="table table-hover">
							<thead>
								<tr>
									<th>Revision</th>
									<th>Author</th>
									<th>Date</th>
									<th>Message</th>
								</tr>
							</thead>
							<tbody id="sym_svn_tab">
							
							</tbody>
						</table>
					</div>
				<div class="col-md-12" style="background-color: #FFE5CC; padding: 0 !important">
					<div class="modal-header" >
						<h4 class="modal-title"><i class="fa fa-code-fork"></i> Footprint History</h4>
					</div>
				</div>
					<div class="col-md-12">
						<table class="table table-hover">
						<thead>
								<tr>
									<th>Revision</th>
									<th>Author</th>
									<th>Date</th>
									<th>Message</th>
								</tr>
							</thead>
							<tbody id="ftpt_svn_tab">
								
							</tbody>
						</table>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				</div>
			</div>

		</div>
	</div>



	<script type="text/javascript" src="{{asset('js/OctoSearch.js')}}"></script>
	<script type="text/javascript">
		$(document.body).addClass('sidebar-collapse');
		$(document).ready(function(){
			getpartspecs();
		});

		function getSVNdata(type, libRef, ftptRef) {
			$('#sym_svn_tab').empty();
			$('#ftpt_svn_tab').empty();
			$('#loader').css('display','block');

			var url = '/Altium/'+ type + '/getsvn';
			var args = {
				libRef: libRef,
				ftptRef: ftptRef
			}
			$.getJSON(url, args, function(response) {
				var FootprintSVN = response.FootprintSVN;
				var SymbolSVN = response.SymbolSVN;
				$.each(SymbolSVN, function(i,symbol){
					$('#sym_svn_tab').append('<tr><td>'+symbol.rev+'</td><td>'+symbol.auth+'</td><td>'+symbol.date+'</td><td>'+symbol.message+'</td></tr>');
				});

				$.each(FootprintSVN, function(i,footprint){
					$('#ftpt_svn_tab').append('<tr><td>'+footprint.rev+'</td><td>'+footprint.auth+'</td><td>'+footprint.date+'</td><td>'+footprint.message+'</td></tr>');
				});
				$('#loader').css('display','none');
			});
		
		}
	</script>

	@endsection