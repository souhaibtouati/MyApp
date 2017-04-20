 <link rel="stylesheet" type="text/css" href="{{asset('/plugins/datepicker/datepicker3.css')}}">
 <div class="box box-widget widget-user">
  <!-- Add the bg color to the header using any of the bg-* classes -->
  <div class="widget-user-header bg-teal-active">
    <h3 class="widget-user-username">Project Request</h3>
    <h5 class="widget-user-desc">PCB</h5>
  </div>
  <div class="widget-user-image">
    <img class="img-circle" src="{{asset('/img/pcb-icon.jpg')}}" alt="pcb">
  </div>
  <div class="box-footer">
    {{Form::open(['url'=>'yproject/save', 'files'=>true])}}

    <div class="row">
      <div class="col-md-4">
        {{Form::label('PCBType', 'PCB Type')}}
        <select class="form-control" id="PCBType" name="PCBType">
          <option value="Qualification Board">Qualification Board</option>
          <option value="HF Test board">HF Test board</option>
          <option value="Internal PCB">Internal PCB</option>
          <option value="Rigid-Flex">Rigid-Flex</option>
          <option value="Flex">Flex</option>
          <option value="Solderability Test">Solderability Test</option>
          <option value="Customer">Customer</option>
        </select>
      </div>
      <div class="col-md-8">
        {{Form::label('Description', 'Description')}}
        {{Form::text('Description', null,['class'=>'form-control'])}}
      </div>


    </div> <!-- form group -->
    <br>
    <div class="row">

      <div class="col-md-4">
        {{Form::label('SolidW', 'Drawing Number')}}
        {{Form::text('SolidW', null,['class'=>'form-control', 'id'=>'conn_num'])}}
      </div>


      <div class="col-md-4">
        {{Form::label('Planta', 'Planta Number')}}
        {{Form::text('Planta', null,['class'=>'form-control'])}}
      </div>


      <div class="col-md-4">
        {{Form::label('BIOS', 'BIOS Number')}}
        {{Form::text('BIOS', null,['class'=>'form-control'])}}
      </div>

    </div>
    <br>
    <div class="row">

      <div class="col-md-4">
        <div class="form-group">
          <label>Due Date</label>
          
          <div class="input-group date">
            <div class="input-group-addon">
              <i class="fa fa-calendar"></i>
            </div>
            <input type="text" class="form-control pull-right" id="datepicker" name="due_date">
          </div>
          <!-- /.input group -->
        </div>
      </div>

      <div class="col-md-4">
        {{Form::label('req_qty', 'Requested Qty')}}
        {{Form::text('req_qty', null, ['class'=>'form-control'])}}
      </div>

      <div class="col-md-4">
        <label class="btn btn-default" for="attachment" style="margin-top: 25px">Attach Document &nbsp <i class="fa fa-paperclip"></i></label>
        {{Form::file('attachment',['style'=>'opacity:0;z-index:-1;position:absolute', 'id'=>'attachment'])}}
        <i id="attachfile" style="margin-top: 30px"></i>
      </div>
    </div>

    <br>
    <div class="row">
      <div class="col-md-4">
        <label style="color:red">Soldering in YED ?</label>
        <input type="checkbox" name="stencil" id="stencil" class="checkbox iCheck">
      </div>
    </div>
    <br>
    <h4 style="margin-bottom: 0px">For Test PCB</h4>
    <hr style="margin-top: 5px">
    <div class="row">
      <div class="col-md-4">
        {{Form::label('tr_proj', 'TR Number')}}
        {{Form::text('tr_proj', null,['class'=>'form-control'])}}
      </div>

      <div class="col-md-4">
      {{Form::label('Conn_typ', 'Connector Type')}}
        {{Form::select('Conn_typ', ['SMD'=>'Surface Mount', 'THT'=>'Through Hole'],'SMD',['class'=>'form-control'])}}
      </div>
    </div>
    <br>
    <div class="row">
      <div class="form-group">
        <div class="col-md-4">
          {{Form::label('hv', 'High Voltage')}}
          {{Form::checkbox('hv', true, true,['class'=>'form-control'])}}
        </div>

        <div class="col-md-4">
          {{Form::label('dr', 'Derating')}}
          {{Form::checkbox('dr', true, true,['class'=>'form-control'])}}
        </div>
        <div class="col-md-4">
          {{Form::label('cr', 'Contact Resistance')}}
          {{Form::checkbox('cr', true, true,['class'=>'form-control'])}}
        </div>
      </div>
    </div>
    <br>
    <div class="row">

      <div class="col-md-4">
        {{Form::label('max_volt', 'Maximum Voltage')}}
        {{Form::text('max_volt', null,['class'=>'form-control'])}}
      </div>

      <div class="col-md-4">
        {{Form::label('max_amp', 'Maximum Current')}}
        {{Form::text('max_amp', null,['class'=>'form-control'])}}
      </div>

    </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        {{Form::label('comment', 'Comment')}}
        <textarea class="form-control" name="comment"></textarea>
      </div>
    </div>

    <div class="col-md-12" style="margin-top: 20px">
      <button type="button" class="btn btn-warning" onclick="$('#savebtn').prop('disabled',false)">Ready ?</button>
      {{ Form::button('Submit <i class="fa fa-send"></i>' , ['class'=>'btn btn-primary pull-right', 'type'=>'submit', 'id'=>'savebtn' ,'disabled'=>true])}}
    </div>
    {{Form::close()}}
  </div>
</div>
<!-- /.widget-user -->
<script src="{{ asset("/plugins/datepicker/bootstrap-datepicker.js")}}"></script>
 <script type="text/javascript">
  $('#datepicker').datepicker({
    format: 'yyyy-mm-dd'
  });
  document.getElementById("attachment").onchange = function() {
    document.getElementById("attachfile").innerHTML = document.getElementById("attachment").value.split("\\").pop();
  };
</script>