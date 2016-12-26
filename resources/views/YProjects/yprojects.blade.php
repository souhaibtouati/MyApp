@extends('layouts.master')

@section('content')
<div class="box box-primary">
	<table class="table table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Proj. Number</th>
			<th>Description</th>
		</tr>
	</thead>
	<tbody>
		@foreach($projects as $project)
		<tr>
			<td>{{$project->id}}</td>
			<td>{{$project->ProjNumber}}</td>
			<td>{{$project->Description}}</td>
			</tr>
		@endforeach
	</tbody>
</table>
</div>
@endsection