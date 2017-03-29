<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">
<head>&#13;
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Reset Your Password</title>
</head>
<body style="display: block; -webkit-text-size-adjust: none; -webkit-font-smoothing: antialiased; width: 100%; height: 100%; color: #37302d; background-color: #ffffff; margin: 0; padding: 0;" bgcolor="#ffffff">
<div style="width:600px; margin: auto;font-family: 'Lato', 'Helvetica Neue', 'Arial', 'sans-serif' !important; font-weight: 400;">
	<div style="width: 100%;height: 100px;background-color: #3399FF;color: white;padding:20px">
    <img src="{{$message->embed(storage_path('/img/lock.png'))}}" style="width: 100px">
    <h1 style="display: inline">Reset your password</h1>
  </div>
  <div>
    <img src="{{$message->embed(public_path('/img/ylogo.png'))}}" style="width: 400px; margin-left: 100px">
    <p>
     Pleaes click on the button below or copy-paste the link in your browser to reset your password.
   </p>

   <br>
   <a href="{{App::make('url')->to('/')}}/pwd-reset/{{$id}}/{{$code}}">{{App::make('url')->to('/')}}/pwd-reset/{{$id}}/{{$code}}</a>
   <br>
   <p>Please note: this link is usable only one time. If you have any trouble connecting to your account please contact:</p>
   <br>
   <p>Souhaib Touati: souhaib.touati@yamaichi.de</p>
   <br><br>

 </div>
 <div style="width: 100%;height: 60px;background-color: #C0C0C0;color: white;text-align: center;padding:20px">
  <h4 style="margin-top: 20px;">Yamaichi Electronics {{date('Y')}}</h4>
</div>
</div>

</body>
</html>
