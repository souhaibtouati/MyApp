<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">
<head>&#13;
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>POR - Yamaichi Electronics GmbH</title>
</head>
<body style="display: block; -webkit-text-size-adjust: none; -webkit-font-smoothing: antialiased; width: 100%; height: 100%; color: #37302d; background-color: #F7F7F7; margin: 0; padding: 0;font-family: 'Helvetica Neue', 'Arial', 'sans-serif' !important; font-weight: 400;" bgcolor="#ffffff">
	
	<div id="container" style="width: 700px; margin: auto; background-color: white; padding: 5px">
	<table style="width: 100%">
				<tbody>
					<tr>
						<td>
							<img src="{{$message->embed(public_path('/img/PO.png'))}}" style="width: 170px; margin-top: 30px" />
						</td>
						<td>
							<img src="{{$message->embed(public_path('/img/ylogo.png'))}}" alt="Yamaichi Electronics" style="width: 300px;margin-top: 10px; margin-left: 120px;" /><br>
							<span style="color: black; font-size:35px; ">
								<strong>
									POR for {{$project->ProjNbr .' '. $order->type}}
								</strong>
							</span><br>

							<span style="color: #606060; font-size:20px;">From: {{$applicant->email}}</span><br>
							
						</td>
					</tr>
				</tbody>
			</table>
		<br><br><br><br>
		<p>
			You have a request to approve a {{$order->type}} order.
		</p>
		<table style="width: 90%">
			<tr><th>Project</th><td>{{$project->Planta}}</td></tr>
			<tr><th>Description</th><td>{{$project->Description}}</td></tr>
			<tr><th>Total Cost</th><td>{{$order->Initial_cost + ($order->cost_piece * $order->qty)}} €</td></tr>
		</table>
		<p>
			Please follow this link: {{url('/yproject').'/'. $project->id .'/view'}}
		</p>
	<br><br><br><br>
	<div style="background-color: #c2c2c2; color: white; padding: 30px; text-align: center; margin-top: 20px">
			Yamaichi Electronics {{date('Y')}}
			<table cellspacing="0" cellpadding="30" width="100%">
				<tr>
					<td style="text-align:center; padding:0 !important; margin-top: 20px">
						<a href="http://www.facebook.com/yamaichielectronics">
							<img width="50" src="{{$message->embed(public_path('/img/icons/facebook.png'))}}" alt="facebook" />
						</a>
						<a href="http://www.kununu.com/yamaichielectronics">
							<img width="100" src="{{$message->embed(public_path('/img/icons/kununu.png'))}}" alt="Kununu" />
						</a>
						<a href="https://www.xing.com/companies/yamaichielectronicsdeutschlandgmbh">
							<img width="50" src="{{$message->embed(public_path('/img/icons/xing.png'))}}" alt="Xing" />
						</a>

					</td>
				</tr>
			</table>
			<p>
				<small>
					YAMAICHI ELECTRONICS Deutschland GmbH <br>
					Concor Park • Bahnhofstraße 20 • 85609 Aschheim-Dornach • Germany
				</small>
			</p>
			<p>
				<a href="http://www.yamaichi.eu" style="color: white;">www.yamaichi.eu</a> </p>
			</div>
			<p><small>
				YAMAICHI Electronics Deutschland GmbH: Managing Board: Helge Puhlmann; Seiichi Kanai; Kazuhiro Matsuda <br>
				Registered office: Bahnhofstraße 20, 85609 Aschheim-Dornach<br>
				Commercial register: München HRB 80980<br>
				VAT Registration No.: DE 129318401<br><br>

				Important Note: This e-mail may contain trade secrets or privileged, undisclosed or otherwise confidential information. If you
				have received this e-mail in error, you are hereby notified that any review, copying or distribution of it is strictly prohibited.
				Please inform us immediately and destroy the original transmittal. Thank you for your cooperation.</small>
			</p>
		</div> <!-- container -->
</body>
</html>
