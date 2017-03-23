
<div style="width:900px; margin: auto;">
	<div style="width: 100%;height: 100px;background-color: #000066;color: white;text-align: center;padding:20px">
		<h1 style="margin-top: 20px;">Reset your password</h1>
	</div>
	<div style="text-align: center">
		
		<p>
			Pleaes click on the link below or copy-paste it in your browser to reset your password.
		</p>
		<br>
		<a href="{{App::make('url')->to('/')}}/pwd-reset/{{$id}}/{{$code}}">{{App::make('url')->to('/')}}/pwd-reset/{{$id}}/{{$code}}</a>
		<br>
		<p>Please note: this link is usable only one time. If you have any trouble connecting to your account please contact:</p>
		<br>
		<p>Souhaib Touati: souhaib.touati@yamaichi.de</p>
		<br><br>
		<img src="{{$message->embed(public_path('/img/ylogo.png'))}}" style="width: 400px">
	</div>
	<div style="width: 100%;height: 100px;background-color: #000066;color: white;text-align: center;padding:20px">
		<h1 style="margin-top: 20px;">Thank you...</h1>
	</div>
</div>