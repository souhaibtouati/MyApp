@extends('layouts.master')

@section('content-header')
	<h1><i class="fa fa-edit"></i><b>Edit</b> project</h1>
@endsection

@section('content')

	<div class="box box-success">
		<div class="box-header">
			<h1 class="box-title">Project <span style="color: DarkBlue">{{$project->ProjNumber}}</span></h1>
		</div>

		<div class="box-body">
			{{Form::model($project, ['url'=>'yproject/update'])}}

			<div class="row">
				<div class="col-md-4">
				{{Form::label('ProductType', 'Project Type')}}
				{{Form::select('ProductType',['PCB'=>'PCB','Software'=>'Software', 'Connector'=>'Connector', 'Socket'=>'Socket', 'Module'=>'Module', 'K'=>'Kit'],null,['class'=>'form-control'])}}
				</div>

				<div class="col-md-6">
				{{Form::label('PartNumber', 'Part Number')}}
				<div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" id="PartNumberCheck" checked="true">
                        </span>
                    {{Form::text('PartNumber', null,['class'=>'form-control', 'id'=>'PartNumber', 'required'=>'true'])}}
                  </div>

				</div>

				<div class="col-md-8">
				{{Form::label('Description', 'Description')}}
				{{Form::text('Description', null,['class'=>'form-control'])}}
				</div>

				</div> <!-- form group -->
				
				<hr>
				<div class="row">
				<div class="col-md-4">
				{{Form::label('SolidW', 'Solid Works')}}
				<div class="input-group">
				<span class="input-group-addon">
                          <input type="checkbox" id="SolidWCheck" checked="true">
                        </span>
				{{Form::text('SolidW', null,['class'=>'form-control', 'id'=>'SolidW', 'required'=>'true'])}}
				</div>
				</div>

				<div class="col-md-4">
				{{Form::label('GenesisW', 'Genesis world')}}
				<div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" id="GenesisWCheck" checked="true">
                        </span>
                    {{Form::text('GenesisW', null,['class'=>'form-control', 'id'=>'GenesisW', 'required'=>'true'])}}
                  </div>
				</div>

				<div class="col-md-4">
				{{Form::label('Planta', 'Planta')}}
				<div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" id="PlantaCheck" checked="true">
                        </span>
                    {{Form::text('Planta', null,['class'=>'form-control', 'id'=>'Planta', 'required'=>'true'])}}
                  </div>
				</div>

				</div> <!-- form group -->

				<hr>
				<div class="row">
				<div class="col-md-4">
				{{Form::label('Application', 'Application')}}
				{{Form::select('Application',['Industrial'=>'Industrial','Internal'=>'Internal', 'Medical'=>'Medical', 'Telecom'=>'Telecom'],null,['class'=>'form-control'])}}

				</div>

				<div class="col-md-4">
				{{Form::label('Customer', 'Customer')}}
				<div class="input-group">
                        <span class="input-group-addon">
                          <input type="checkbox" id="CustomerCheck" checked="true">
                        </span>
                    {{Form::text('Customer', null,['class'=>'form-control', 'id'=>'Customer', 'required'=>'true'])}}
                  </div>
				</div>

				<div class="col-md-4">
				{{Form::label('Responsible', 'Responsible')}}
				{{Form::text('Responsible', null,['class'=>'form-control', 'required'=>'true'])}}
				</div>

				</div>
				{{Form::submit('Save', ['class'=>'btn btn-success pull-right'])}}
			
		</div>

		
			{{Form::close()}}
		</div>


@endsection