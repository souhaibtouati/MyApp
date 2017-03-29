<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml">
<head>&#13;
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>Yamaichi Electronics GmbH</title>
</head>
<body style="display: block; -webkit-text-size-adjust: none; -webkit-font-smoothing: antialiased; width: 100%; height: 100%; color: #37302d; background-color: #F7F7F7; margin: 0; padding: 0;font-family: 'Helvetica Neue', 'Arial', 'sans-serif' !important; font-weight: 400;" bgcolor="#ffffff">


	<div id="container" style="width: 700px; margin: auto; background-color: white; padding: 5px">
		<div style="background-color: #FFFFFF; height: 220px">
			<table style="width: 100%">
				<tbody>
					<tr>
						<td>
							<img src="{{url('/img/pcb-collage.jpg')}}" style="width: 227px; margin-top: 50px" />
						</td>
						<td>
							<img src="{{url('/img/ylogo.png')}}" alt="Yamaichi Electronics" style="width: 300px;margin-top: 10px; margin-left: 120px;" /><br>
							<span style="color: black; font-size:35px; ">
								<strong>
									@if($data['type'] == 'Quotation')
									PCB Quotation Request
									@endif
									@if($data['type'] == 'Order')
									PCB Production Request
									@endif
								</strong>
							</span><br>

							<span style="color: #606060; font-size:20px;">From: {{$data['user']}}</span><br>
							
							<span style="color: #606060; font-size:20px;">To: {{$data['manufacturer']}}</span>

						</td>
					</tr>
				</tbody>
			</table>
		</div>

		<div style="text-align: left; margin-top: 10px">
			<p>Dear Madams and Sirs,</p>
			<p>
				@if($data['type'] == 'Quotation')
				Please give us an offer according to the attached PCB data and below informations.
				@endif
				@if($data['type'] == 'Order')
				Please use the attached data and below information for PCB Manufacturing.
				@endif
				
			</p>
		</div>
		<div style="background-color: #3399FF; color: white; text-align: left; padding-left: 10px"><h2>General Informations</h2></div>

		<table style="text-align: left; width: 100%">
			<tbody>
				<tr>
					<td style="color: #606060; width: 200px">Project</td>
					<td>{{$json->project}}</td>
				</tr>

				<tr>
					<td style="color: #606060; width: 200px">Quantity</td>
					<td>{{$json->qty}}</td>
				</tr>

				<tr>
					<td style="color: #606060; width: 200px">Delivery</td>
					<td>{{$json->delivery}} Days</td>
				</tr>

				<tr>
					<td style="color: #606060; width: 200px">Attachment</td>
					<td>{{$json->attachment}}</td>
				</tr>

			</tbody>
		</table>

		<div style="background-color: #3399FF; color: white; text-align: left; padding-left: 10px"><h2>Dimensions</h2></div>

		<table style="text-align: left;  width: 100%">
			<tbody>
				<tr>
					<td style="color: #606060; width: 200px">PCB width <small>(mm)</small></td>
					<td style="width: 155px">{{$json->width}}</td>
					<td style="color: #606060; width: 200px">PCB Layers</td>
					<td style="width: 155px">{{$json->layers}}</td>
				</tr>

				<tr>
					<td style="color: #606060; width: 200px">PCB height <small>(mm)</small></td>
					<td style="width: 155px">{{$json->height}}</td>
					<td style="color: #606060; width: 200px">Outer Copper <small>(um)</small></td>
					<td style="width: 155px">{{$json->out_copper}}</td>
				</tr>

				<tr>
					<td style="color: #606060; width: 200px">PCB thickness <small>(mm)</small></td>
					<td style="width: 155px">{{$json->thickness}}</td>
					<td style="color: #606060; width: 200px">Inner Copper <small>(um)</small></td>
					<td style="width: 155px">{{$json->in_copper}}</td>
				</tr>
			</tbody>
		</table>


		<div style="background-color: #3399FF; color: white; text-align: left; padding-left: 10px"><h2>Materials</h2></div>
		<table style="text-align: left; width: 100%"">
			<tbody>
				<tr>
					<td style="color: #606060; width: 200px">PCB Type</td>
					<td style="width: 155px">{{$json->pcb_type}}</td>
					<td style="color: #606060; width: 200px">PCB material</td>
					<td style="width: 155px">{{$json->pcb_core}}</td>
				</tr>
				<tr>
					<td style="color: #606060; width: 200px">Top Silk</td>
					<td style="width: 155px">{{$json->top_silk}}</td>
					<td style="color: #606060; width: 200px">Solder Mask</td>
					<td style="width: 155px">{{$json->solder_mask}}</td>
				</tr>
				<tr>
					<td style="color: #606060; width: 200px">Bottom Silk</td>
					<td style="width: 155px">{{$json->bottom_silk}}</td>
					<td style="color: #606060; width: 200px"></td>
					<td style="width: 155px"></td>
				</tr>
				<tr>
					<td style="color: #606060; width: 200px">Surface Finish</td>
					<td style="width: 155px">{{$json->surface}}</td>
					<td style="color: #606060; width: 200px"></td>
					<td style="width: 155px"></td>
				</tr>

			</tbody>
		</table>
		<div style="background-color: #3399FF; color: white; text-align: left; padding-left: 10px"><h2>Layout</h2></div>
		<table style="text-align: left;">
			<tbody>
				<tr><td style="color: #606060; width: 200px">Min. Track width <small>(mm)</small></td><td>{{$json->min_track}}</td></tr>
				<tr><td style="color: #606060; width: 200px">Min. Clearance <small>(mm)</small></td><td>{{$json->min_clearance}}</td></tr>
				<tr><td style="color: #606060; width: 200px">Impedance Control</td><td>{!! $json->impedance ? '<strong style="color: green">✓</strong>' : '<strong style="color: red">X</strong>' !!}</td></tr>
			</tbody>
		</table>
		<div style="background-color: #3399FF; color: white; text-align: left; padding-left: 10px"><h2>Drilling</h2></div>
		<table style="text-align: left; width: 100%">
			<tbody>
				<tr>
					<td style="color: #606060; width: 200px">Smallest Hole <small>(mm)</small></td>
					<td style="width: 155px">{{$json->smallest_hole}}</td>
					<td style="color: #606060; width: 200px">Blind Via</td>
					<td style="width: 155px">{{$json->blind_via}}</td>
				</tr>


				<tr>
					<td style="color: #606060; width: 200px">Biggest Hole <small>(mm)</small></td>
					<td style="width: 155px">{{$json->biggest_hole}}</td>
					<td style="color: #606060; width: 200px">Burried Via</td>
					<td style="width: 155px">{{$json->burried_via}}</td>
				</tr>

				<tr>
					<td style="color: #606060; width: 200px">Different hole Sizes <small>(mm)</small></td>
					<td style="width: 155px">{{$json->diff_hole_count}}</td>
					<td style="color: #606060; width: 200px">Laser Drill</td>
					<td style="width: 155px">{!! $json->laser_drill ? '<strong style="color: green">✓</strong>' : '<strong style="color: red">X</strong>' !!}</td>
				</tr>
				<tr><td style="color: #606060; width: 200px">Max. Aspect Ratio</td><td>{{$json->aspect_ratio}}</td></tr>

			</tbody>
		</table>
		
		<div style="background-color: #3399FF; color: white; text-align: left; padding-left: 10px"><h2>Options</h2></div>
		<table style="text-align: left;">
			<tbody>
				<tr>
					<td style="color: #606060; width: 200px">Board Outline</td>
					<td>{{ $json->board_outline }}</td>
				</tr>
				<tr>
					<td style="color: #606060; width: 200px">Electrical Test</td>
					<td>{!! $json->elec_test ? '<strong style="color: green">✓</strong>' : '<strong style="color: red">X</strong>' !!}</td>
				</tr>
				<tr>
					<td style="color: #606060; width: 200px">Visual Inspection</td>
					<td>{!! $json->visual_inspect ? '<strong style="color: green">✓</strong>' : '<strong style="color: red">X</strong>' !!}</td>
				</tr>
				
			</tbody>
		</table>

		<div style="background-color: #c2c2c2; color: white; padding: 30px; text-align: center; margin-top: 20px">
			Yamaichi Electronics {{date('Y')}}
			<table cellspacing="0" cellpadding="30" width="100%">
				<tr>
					<td style="text-align:center; padding:0 !important; margin-top: 20px">
						<a href="http://www.facebook.com/yamaichielectronics">
							<img width="50" src="{{url('/img/icons/facebook.png')}}" alt="facebook" />
						</a>
						<a href="http://www.kununu.com/yamaichielectronics">
							<img width="100" src="{{url('/img/icons/kununu.png')}}" alt="Kununu" />
						</a>
						<a href="https://www.xing.com/companies/yamaichielectronicsdeutschlandgmbh">
							<img width="50" src="{{url('/img/icons/xing.png')}}" alt="Xing" />
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

		</div>

	</body>
	</html>
