@extends('layouts.master')

@section('content-header')
	<h1><i class="fa fa-plus"></i> New project</h1>
@endsection

@section('content')

	<div class="box box-success">
		<div class="box-header">
			
		</div>

		<div class="box-body">
			{{Form::open(['url'=>'yproject/create'])}}

				<div class="col-md-2">
				{{Form::label('ProductType', 'Project Type')}}
				{{Form::select('ProductType',['pcb'=>'PCB','sw'=>'Software'],null,['class'=>'form-control'])}}
				</div>

				<div class="col-md-4">
				{{Form::label('Description', 'Description')}}
				{{Form::text('Description', null,['class'=>'form-control'])}}
				</div>

		</div>
	</div>

		<div class="box box-success">
		<div class="box-header">
			<b>References</b>
		</div>

		<div class="box-body">

				<div class="col-md-2">
				{{Form::label('SolidW', 'Solid Works')}}
				{{Form::text('SolidW', null,['class'=>'form-control'])}}
				</div>

				<div class="col-md-2">
				{{Form::label('GenesisW', 'Genesis world')}}
				{{Form::text('GenesisW', null,['class'=>'form-control'])}}
				</div>

				<div class="col-md-2">
				{{Form::label('Planta', 'Planta')}}
				{{Form::text('Planta', null,['class'=>'form-control'])}}
				</div>

			{{Form::close()}}
		</div>
	</div>

@endsection