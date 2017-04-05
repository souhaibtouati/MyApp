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
 <h1><i class="fa fa-users"></i> <b>Users</b> Administration </h1>

@endsection

@section('content')
<div class="box box-default">
<div class="box-header">
  <a href="{{url('/user/create')}}" class="btn btn-warning pull-left">New User &nbsp&nbsp<i class="fa fa-plus"></i></a>
</div>
<div class="box-body">

    <table class="table table-hover" id="userslist" name="userslist">

      <thead>
        <tr>
         <th>Id</th>
         <th>First Name</th>
         <th>Last Name</th>
         <th>Email</th>
         <th>Dep</th>
         <th>Last Login</th>
         <th>Created At</th>
         <th>Activation</th>
         <th></th>
       </tr>
     </thead>

     <tbody>
      @foreach ($users as $user)
      <tr>
       <td>{{ $user->id}}</td>
       <td>{{ $user->first_name }}</td>
       <td>{{ $user->last_name }}</td>
       <td>{{ $user->email }}</td>
       <td>{{ $user->departement }}</td>
       <td>{{ $user->last_login}}</td>
       <td>{{ $user->created_at->format('F d, Y h:ia') }}</td>

       @if (Activation::completed($user))
       <td><span class="label label-success">Activated</span></td>
       @else
       <td>
        <div class="input-group-btn">
          <button type="button" class="btn btn-warning btn-xs" data-toggle="dropdown" >Pending&nbsp 
            <span class="fa fa-caret-down"></span></button>
            <ul class="dropdown-menu">
              <li><a href="{{url('/user/'. $user->id . '/activate')}}">Activate</a></li>
            </ul>
          </div>
        </td>
        @endif

        <td style="white-space: nowrap;">
          <a href="{{url('/user/'. $user->id . '/edit')}}" class="btn btn-primary pull-left" style="margin-right: 3px;"><i class="fa fa-edit"></i></a>
          {{ Form::open(['url' => '/user/' . $user->id, 'method' => 'DELETE', 'class'=>'delete']) }}
          {{ Form::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-danger', 'id'=>'delete', 'data-toggle'=>'modal','data-target'=>'#confirmDelete'])}}
          {{ Form::close() }}
        </td>
      </tr>
      @endforeach
    </tbody>

  </table>
  @include('partials.deletemodal')


  

  

</div>
</div>
@endsection


@section ('footer')
<script type="text/javascript">
  $(function() {
   $('#userslist').DataTable({
    /* Disable initial sort */
    "aaSorting": [],
  });
 });
</script>


@endsection