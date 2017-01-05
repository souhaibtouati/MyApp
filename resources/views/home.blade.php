@extends('layouts.master')

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

