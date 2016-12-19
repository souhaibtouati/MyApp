@extends('layouts.master')

@section('content')

<h1>Welcome back {{Sentinel::getUser()->first_name}}</h1>
<div class="container" style="padding: 15%; margin-left:100px">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <img src="{{asset('img/ylogo.png')}}" >
        </div>
    </div>
</div>
@endsection

