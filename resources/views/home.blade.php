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
 <div class="box box-widget widget-user">
  <div class="widget-user-header bg-red-active">
    <h3 class="widget-user-username">My Projects</h3>
    <h5 class="widget-user-desc">List of projects that I created or I am assigned to</h5>
  </div>
  <div class="widget-user-image">
    <img class="img-circle" src="{{asset('/img/ylogo-Circ.png')}}" alt="pcb">
  </div>
  <div class="box-footer">
   {{csrf_field()}}
   <table class="table" id="projtab">
    <thead>
     <tr>
      <th>Project</th>
      <th>Description</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody id="my-projs">
   
  </tbody>
</table>
</div>
</div>	

<div class="box box-info">
  <div class="box-header with-border">
    <h3 class="box-title">My Tasks</h3>

    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <div class="table-responsive">
      <table class="table no-margin">
        <thead>
          <tr>
            <th>Task ID</th>
            <th>Description</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><a href="pages/examples/invoice.html">STO0005</a></td>
            <td>Design Test PCB 5</td>
            <td><span class="label label-success">Finished</span></td>
          </tr>
          <tr>
            <td><a href="pages/examples/invoice.html">STO0004</a></td>
            <td>Design Test PCB 4</td>
            <td><span class="label label-warning">Pending</span></td>
          </tr>
          <tr>
            <td><a href="pages/examples/invoice.html">STO0003</a></td>
            <td>Design Test PCB 3</td>
            <td><span class="label label-danger">Delivered</span></td>
          </tr>
          <tr>
            <td><a href="pages/examples/invoice.html">STO0002</a></td>
            <td>Design Test PCB 2</td>
            <td><span class="label label-info">Processing</span></td>
          </tr>
          <tr>
            <td><a href="pages/examples/invoice.html">STO0001</a></td>
            <td>Design Test PCB 1</td>
            <td><span class="label label-warning">Pending</span></td>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /.table-responsive -->
  </div>
  <!-- /.box-body -->
  <div class="box-footer clearfix">
    <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">New Task</a>
    <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Tasks</a>
  </div>
  <!-- /.box-footer -->
</div>
</div>


<div class="col-md-6">
  {!! View::make('partials.altium.projreq') !!}
</div> <!-- col-md-6 -->
@endsection

@section('footer')

<script type="text/javascript">

  const StatusList = {
    Design: '#E0E0E0',
    Quotation:'#FF9999',
    Approval:'#FFFF99',
    Production:'#99CCFF',
    Delivery:'#FFB266',
    Delivered:'#00CC00',
    Cancelled:'#FFFFFF'};
    
    var	token = $('input[name=_token]').val();
    $.ajax({
      url: 'yproject/myprojects',
      headers: {'X-CSRF-TOKEN': token},
      type: 'GET',
    }).success(function(projs){
      
      $.each(projs, function(key, data){
       $('#my-projs').append('<tr><td><a href="'+ data.path + '">'+ data.Planta +'</a></td><td>'+ data.Description +'</td><td style="background-color:'+StatusList[data.Status]+'";>'+ data.Status +'</td></tr>');
     });
    }).done(function(){
      $('#projtab').DataTable();
    });
    
  </script>

  <script type="text/javascript">
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
    });
  </script>

  @endsection

