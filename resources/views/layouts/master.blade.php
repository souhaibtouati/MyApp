<!DOCTYPE html>

<html>
<head>
    <meta charset="UTF-8">
    <title>{{ $page_title or "Yamaichi Electronics" }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="{{ asset("/css/font-awesome-4.7.0/css/font-awesome.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="{{ asset("/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins.   -->
      <link href="{{ asset("/css/skins/skin-blue.min.css")}}" rel="stylesheet" type="text/css" />

      <!-- jQuery 2.2.3 -->
      <script src="{{ asset("/plugins/jQuery/jquery-2.2.3.min.js")}}"></script>

      <!-- jQuery UI -->
      <script src="{{ asset("/plugins/jQueryUI/jquery-ui.min.js")}}"></script>

      <!-- iCheck -->
      <link rel="stylesheet" href="{{ asset("/plugins/iCheck/square/blue.css")}}"">
      <!-- Pace -->
      <link rel="stylesheet" href="{{ asset("/plugins/pace/pace.min.css")}}"">
      <script type="text/javascript" src="{{asset('plugins/pace/pace.min.js')}}"></script>
      <!-- iCheck -->
      <script src="{{ asset ("/plugins/iCheck/icheck.min.js")}}"></script>

      <link rel="stylesheet" type="text/css" href="{{ asset('plugins/select2/select2.min.css')}}">

      <link rel="stylesheet" type="text/css" href="{{ asset('plugins/overhang/overhang.min.css')}} ">


      @yield('head')

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

<body class="skin-blue">
    <div class="wrapper">

        <!-- Header -->
        @include('layouts.header')

        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" style="min-width: 470px">
            <!-- Content Header (Page header) -->
            <section class="content-header">
            @yield('content-header')
              
            </section>


            <!-- Main content -->
            <section class="content">

                @include('partials.flash')

                @yield('content')
            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->
        
       
    </div><!-- ./wrapper -->


<section class="footer">
        <!-- Footer -->
         @yield('footer')
    <!-- REQUIRED JS SCRIPTS -->
    <script type="text/javascript">
        $('div.alert').not('.alert-important').delay(2500).slideUp(500);
    </script>

    <script src="{{ asset ("/plugins/overhang/overhang.min.js")}}"></script>

    <!-- Bootstrap 3.3.6 -->
    <script src="{{ asset ("/js/bootstrap.min.js")}}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset ("/js/app.min.js") }}" type="text/javascript"></script>

<script type="text/javascript" src="{{asset('plugins/select2/select2.full.min.js')}}"></script>

<script type="text/javascript">
  $('.select2').select2();
</script>




<script>    
  $('#confirmDelete').on('show.bs.modal', function (e) {
    $message = $(e.relatedTarget).attr('data-message');
    $(this).find('.modal-body p').text($message);
    $title = $(e.relatedTarget).attr('data-title');
    $(this).find('.modal-title').text($title);

      // Pass form reference to modal for submission on yes/ok
      var form = $(e.relatedTarget).closest('form');
      $(this).find('.modal-footer #confirm').data('form', form);
    });

      // Form confirm (yes/ok) handler, submits form 
      $('#confirmDelete').find('.modal-footer #confirm').on('click', function(){
        $(this).data('form').submit();
      });

    </script>

</section>      
  </body>
  </html>