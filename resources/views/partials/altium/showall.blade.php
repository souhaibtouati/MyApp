@foreach($parts as $part)
<tr>
<td>{{$part->Y_PartNr}}</td>
<td>{{$part->Description}}</td>
<td>{{$part->Manufacturer}}</td>
<td>{{$part['Manufacturer Part Number']}}</td>
<td>{{$part ['Library Ref']}}</td>
<td>{{$part['Footprint Ref']}}</td>
<td style="display:flex;">
<a href="{{url('/Altium/'. $part->getName(). '/'. $request->table . '/' .$part->id .'/view')}}" class="btn btn-info pull-left" target="_blank" style="margin-right: 3px;"><i class="fa fa-eye"></i></a>

<a href="{{url('/Altium/'. $part->getName(). '/'. $request->table . '/' .$part->id .'/edit')}}" class="btn btn-primary pull-left" target="_blank" style="margin-right: 3px;"><i class="fa fa-edit"></i></a>			

<button class="dl-btn btn btn-danger" data-toggle="modal" data-target="#confirmDeletePart" data-type="{{$type}}" data-table="{{$request->table}}" data-id="{{$part->id}}" onclick="PrepareDelete(this)"><i class="fa fa-trash"></i>
</button>
</td>
</tr>
@endforeach