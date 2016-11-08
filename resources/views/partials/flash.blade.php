@if ($errors->any())
<script type="text/javascript">
$(document).ready(function(){
    var message = "{{implode($errors->all(), ' -- ')}}"; 
        $(".wrapper").overhang({
                type: "error",
                message: message,
                duration: 2,
                closeConfirm: "true"
            });
        });
</script>
@endif


@if (Session()->has('success'))
<script type="text/javascript">
$(document).ready(function(){
        $(".wrapper").overhang({
                type: "success",
                message: "{{ Session::get('success')}}",
                duration: 2
            });
        });
</script>
@endif

@if (Session()->has('info'))

<script type="text/javascript">
$(document).ready(function(){
        $(".wrapper").overhang({
                type: "info",
                message: "{{ Session::get('info')}}",
                duration: 2
            });
        });
</script>

@endif


@if (Session()->has('warning'))

<script type="text/javascript">
$(document).ready(function(){
        $(".wrapper").overhang({
                type: "warning",
                message: "{{ Session::get('warning')}}",
                duration: 2
            });
        });
</script>

@endif