<div id="container" style="width: 700px; margin: auto;">
<div style="text-align: left">
<p>Dear Madams and Sirs,
	Please give us an offer for the attached PCB data.
	Thank you.
	Best reagards</p>
</div>
	<div style="background-color: #004C99; color: white; text-align: center"><h2>General Informations</h2></div>
	<div style="width: 100%">
		<table style="text-align: left;">
			<tbody>
				<tr><th style="width: 200px">Project</th><td>{{$json->project}}</td></tr>
				<tr><th>Quantity</th><td>{{$json->qty}}</td></tr>
				<tr><th>Delivery</th><td>{{$json->delivery}} Days</td></tr>
				<tr><th>Attachment</th><td>{{$json->attachment}}</td></tr>
				
			</tbody>
		</table>
	</div>
	<div style="background-color: #004C99; color: white; text-align: center"><h2>Dimensions</h2></div>
	<table style="text-align: left; margin: auto; float: left; width: 400px">
		<tbody>
			<tr><th style="width: 200px">PCB width <small>(mm)</small></th><td>{{$json->width}}</td></tr>
			<tr><th>PCB height <small>(mm)</small></th><td>{{$json->height}}</td></tr>
			<tr><th>PCB thickness <small>(mm)</small></th><td>{{$json->thickness}}</td></tr>
		</tbody>
	</table>
	<table style="text-align: left;">
		<tbody>
			<tr><th  style="width: 200px">PCB Layers</th><td>{{$json->layers}}</td></tr>
			<tr><th>Outer Copper <small>(um)</small></th><td>{{$json->out_copper}}</td></tr>
			<tr><th>Inner Copper <small>(um)</small></th><td>{{$json->in_copper}}</td></tr>
		</tbody>
	</table>

	<div style="background-color: #004C99; color: white; text-align: center"><h2>Materials</h2></div>
	<table style="text-align: left;">
		<tbody>
			<tr><th style="width: 200px">Top Silk</th><td>{{$json->top_silk}}</td></tr>
			<tr><th>Bottom Silk</th><td>{{$json->bottom_silk}}</td></tr>
			<tr><th>Solder Mask</th><td>{{$json->solder_mask}}</td></tr>
			<tr><th>PCB material</th><td>{{$json->pcb_core}}</td></tr>
			<tr><th>Surface Finish</th><td>{{$json->surface}}</td></tr>

		</tbody>
	</table>
	<div style="background-color: #004C99; color: white; text-align: center"><h2>Layout</h2></div>
	<table style="text-align: left;">
		<tbody>
			<tr><th style="width: 200px">Min. Track width <small>(mm)</small></th><td>{{$json->min_track}}</td></tr>
			<tr><th>Min. Clearance <small>(mm)</small></th><td>{{$json->min_clearance}}</td></tr>
			<tr><th>Max. Aspect Ratio</th><td>{{$json->aspect_ratio}}</td></tr>
			<tr><th>Impedance Control</th><td>{{$json->impedance}}</td></tr>
		</tbody>
	</table>
	<div style="background-color: #004C99; color: white; text-align: center"><h2>Drilling</h2></div>
	<table style="text-align: left; margin: auto; float: left; width: 400px">
		<tbody>
			<tr><th style="width: 200px">Smallest Hole <small>(mm)</small></th><td>{{$json->smallest_hole}}</td></tr>
			<tr><th>Biggest Hole <small>(mm)</small></th><td>{{$json->biggest_hole}}</td></tr>
			<tr><th>Different hole Sizes <small>(mm)</small></th><td>{{$json->diff_hole_count}}</td></tr>
		</tbody>
	</table>
	<table style="text-align: left;">
		<tbody>
			<tr><th style="width: 200px">Blind Via</th><td>{{$json->blind_via}}</td></tr>
			<tr><th>Burried Via</th><td>{{$json->burried_via}}</td></tr>
			<tr><th>Laser Drill</th><td>{{$json->laser_drill}}</td></tr>
		</tbody>
	</table>

</div>