@extends('layouts.master')

@section('content-header')
	<h1><i class="fa fa-industry"></i><b> PCB</b> Manufacturers</h1>
@endsection

@section('content')
<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">New Manufacturer</h3>
	</div>
	<div class="box-body">
		{{Form::open(['url'=>'/yproject/new_manuf'])}}
			<div class="form-group">
			<div class="col-md-2">
				{{form::label('name','Name')}}
				{{form::text('name', null, ['class'=>'form-control'])}}
			</div>
			<div class="col-md-2">
				{{form::label('email','Email')}}
				{{form::text('email', null, ['class'=>'form-control'])}}
			</div>
			<div class="col-md-8">
				{{form::label('adress','Adress')}}
				{{form::text('adress', null, ['class'=>'form-control'])}}
			</div>	
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

			{{ Form::button('<i class="fa fa-save"></i> Save' , ['class'=>'btn btn-success ', 'type'=>'submit', 'style'=>'margin-top:25px'])}}
			</div>
		{{Form::close()}}
	</div>
</div>

<div class="box box-warning">
	<div class="box-header">
		<h3 class="box-title">Manufacturers List</h3>
	</div>
	<div class="box-body">
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Name</th><th>Email</th><th>Phone</th><th>BIOS</th><th>Product</th>
				</tr>
			</thead>
			<tbody>
				@foreach($manufs as $manuf)
				<tr>
					<td>{{$manuf->name}}</td>
					<td>{{$manuf->email}}</td>
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