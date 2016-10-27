@extends('layouts.master')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <h2>Welcome {{Sentinel::getUser()->first_name}}</h2>
                    <h3>This is Altium Components</h3>



                </div>
            </div>
        </div>
    </div>
</div>
@endsection

