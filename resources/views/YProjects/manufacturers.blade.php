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
<h1><i class="fa fa-industry"></i><b> PCB</b> Manufacturers</h1>
@endsection

@section('content')
<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">New Manufacturer</h3>
		<div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
	</div>
	<div class="box-body">
		{{Form::open(['url'=>'/yproject/new_manuf'])}}
		<div class="form-group">
			<div class="row">
				<div class="col-md-2">
					{{form::label('name','Name')}}
					{{form::text('name', null, ['class'=>'form-control'])}}
				</div>
				
				<div class="col-md-8">
					{{form::label('adress','Adress')}}
					{{form::text('adress', null, ['class'=>'form-control'])}}
				</div>	
			</div>
			<div class="row">
				<div class="col-md-2">
					{{form::label('email1','Email 1')}}
					{{form::text('email1', null, ['class'=>'form-control'])}}
				</div>
				<div class="col-md-2">
					{{form::label('email2','Email 2')}}
					{{form::text('email2', null, ['class'=>'form-control'])}}
				</div>
				<div class="col-md-2">
					{{form::label('email3','Email 3')}}
					{{form::text('email3', null, ['class'=>'form-control'])}}
				</div>
			</div>
			<div class="row">
							<div class="col-md-2">
								{{form::label('phone','Phone')}}
								{{form::text('phone', null, ['class'=>'form-control'])}}
							</div>	
							<div class="col-md-2">
								{{form::label('BIOS','BIOS Number')}}
								{{form::text('BIOS', null, ['class'=>'form-control'])}}
							</div>	
							<div class="col-md-2">
								{{form::label('product','Product')}}
								{{form::select('product', ['PCB'=>'PCB','Stencil'=>'Stencil'], null, ['class'=>'form-control'])}}
							</div>	
				
							{{ Form::button('<i class="fa fa-save"></i> Save' , ['class'=>'btn btn-success ', 'type'=>'submit', 'style'=>'margin-top:25px'])}}</div>
		</div>
		{{Form::close()}}
	</div>
</div>

<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Manufacturers List</h3>
	</div>
	<div class="box-body">
		<table class="table table-hover" id="Manufacturers-table">
			<thead>
				<tr>
					<th>Name</th><th>Adress</th><th>Email</th><th>Phone</th><th>BIOS</th><th>Product</th>
				</tr>
			</thead>
			<tbody>
				@foreach($manufs as $manuf)
				<tr>
					<td>{{$manuf->name}}</td>
					<td>{{$manuf->adress}}</td>
					<td>{{$manuf->email1}}</td>
					<td>{{$manuf->phone}}</td>
					<td>{{$manuf->BIOS}}</td>
					<td>{{$manuf->product}}</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection

@section('footer')
<script type="text/javascript">
	$('#Manufacturers-table').DataTable();
</script>
@endsection