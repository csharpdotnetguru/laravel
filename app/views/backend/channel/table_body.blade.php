@foreach($channels as $channel)
<tr>
    <td>{{link_to_route('channel_detail',$channel->id,[$channel->id],['target'=>'_blank'])}}</td>
    <td><a href="{{$channel->image_url}}"><img src="{{$channel->image_url}}" /></a></td>
    <td><a href="{{$channel->channel_url}}">{{$channel->channel_url}}</a></td>
    <td>{{$channel->description}}</td>
    <td>{{$channel->type}}</td>
    <td>{{$channel->display}}</td>
    <td>{{$channel->competitor}}</td>
    <td>{{$channel->premium}}</td>
    <td>{{$channel->gold}}</td>
    <td>{{$channel->display_order}}</td>
    <td>{{$channel->name}}</td>
    <td>{{$channel->comment}}</td>
    <td class="clickable" data-edit-link="{{URL::route('channel_edit',[$channel->id])}}" onclick="edit_old(this)">Edit

        <br></td>
    <td>{{ link_to_route('channel_edit', 'Edit', array($channel->id)) }}</td>
</tr>
@endforeach