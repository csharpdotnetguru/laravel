@foreach($networks as $network)
<tr>
    <td>{{Form::checkbox($network->id)}}</td>
    <td>{{$network->id}}</td>
    <td>{{$network->user_id}}</td>
    <td>{{$network->client_ip}}</td>
    <td>{{$network->ip_status}}</td>
    <td>{{$network->ip_label}}</td>
    <td class="clickable" data-edit-link="{{URL::route('admin_network_edit',['id'=>$network->id])}}" onclick="edit_old(this)">Edit</td>
</tr>
@endforeach