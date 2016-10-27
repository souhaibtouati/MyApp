@if ($errors->any())
<div style="margin-left:25%;width:50%">
    <div class="alert alert-danger alert-dismissible {{ Session::has('important') ? 'alert-important' : ''}} ">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
        <h4><i class="icon fa fa-ban"></i>{{ Session::get('title')}} </h4>
        @foreach($errors->all() as $error)
        {{ $error }}<br>
        @endforeach
    </div>
</div>
@endif


@if (Session()->has('success'))
<div style="margin-left:25%; width:50%">
<div class="alert alert-success alert-dismissible {{ Session::has('important') ? 'alert-important' : ''}}">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
		<h4><i class="icon fa fa-check">{{ Session::get('title')}}</i></h4>
		{{ Session::get('success')}}

	</div>
</div>
@endif

@if (Session()->has('info'))
<div style="margin-left:25%; width:50%">
<div class="alert alert-info alert-dismissible {{ Session::has('important') ? 'alert-important' : ''}}">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h4><i class="icon fa fa-check">{{ Session::get('title')}}</i></h4>
        {{ Session::get('info')}}

    </div>
</div>
@endif