@foreach($parts as $part)
<tr>
<td>{{$part->Y_PartNr}}</td>
<td>{{$part->Description}}</td>
<td>{{$part->Manufacturer}}</td>
<td>{{$part['Manufacturer Part Number']}}</td>
<td>{{$part['Library Ref']}}</td>
<td>{{$part['Footprint Ref']}}</td>
<td>
<<<<<<< HEAD
<a href="{{url('/Altium/'. $part->getName(). '/'. $table . '/' .$part->id .'/view)}}" class="btn btn-info pull-left" target="_blank" style="margin-right: 3px;"><i class="fa fa-eye"></i></a>

<a href="{{url('/Altium/'. $part->getName(). '/'. $table . '/' .$part->id .'/edit)}}" class="btn btn-primary pull-left" target="_blank" style="margin-right: 3px;"><i class="fa fa-edit"></i></a>
=======
<a href="{{url('/Altium/'. $part->getName(). '/'. $table . '/' .$part->id .'/view')}}" class="btn btn-info pull-left" target="_blank" style="margin-right: 3px;"><i class="fa fa-eye"></i></a>

<a href="{{url('/Altium/'. $part->getName(). '/'. $table . '/' .$part->id .'/edit')}}" class="btn btn-primary pull-left" target="_blank" style="margin-right: 3px;"><i class="fa fa-edit"></i></a>
>>>>>>> 62cf975f9637cfe42ae8627863ebdd607e766816
</td>
</tr>
@endforeach