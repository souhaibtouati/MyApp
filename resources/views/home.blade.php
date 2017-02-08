@extends('layouts.master')

@section ('head')
<!-- datatables -->
<link href="{{ asset("/plugins/datatables/dataTables.bootstrap.css") }}" rel="stylesheet" type="text/css" />
<!-- jQuery datatables -->
<script src="{{ asset("/plugins/datatables/jquery.dataTables.min.js")}}"></script>
<!-- bootstrap datatables -->
<script src="{{ asset("/plugins/datatables/dataTables.bootstrap.min.js")}}"></script>
@endsection

@section('content-header')
	<h1><b>Welcome back</b> {{Sentinel::getUser()->first_name}}</h1>
@endsection

@section('content')
<div class="col-md-6">
	<div class="box box-primary">
		<div class="box-header">
			<h3 class="box-title"><i class="fa fa-list"></i> My Projects</h3>
		</div>
		<div class="box-body">
		{{csrf_field()}}
		<table class="table" id="projtab">
			<thead>
				<tr>
					<th>Project</th>
					<th>Description</th>
					<th>Planta</th>
				</tr>
			</thead>
			<tbody id="my-projs">
				
			</tbody>
		</table>
		</div>
	</div>	
</div>

<div class="col-md-6">
	<div class="box box-primary box-expended">
		<div class="box-header with-border">
				<h1 class="box-title"><i class="fa fa-edit"></i> Create Project</h1>
				<div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
          </button>
        </div>
		</div>
		<div class="box-body">
		
		</div>
	</div>
</div>
@endsection

@section('footer')

<script type="text/javascript">
var	token = $('input[name=_token]').val();
	$.ajax({
		url: 'yproject/myprojects',
		headers: {'X-CSRF-TOKEN': token},
		type: 'GET',
	}).success(function(projs){
		
		$.each(projs, function(key, data){
			$('#my-projs').append('<tr><td>'+ data.ProjNumber +'</td><td>'+ data.Description +'</td><td>'+ data.Planta +'</td></tr>');
		});
	}).done(function(){
		$('#projtab').DataTable();
	});
	
</script>

@endsection

