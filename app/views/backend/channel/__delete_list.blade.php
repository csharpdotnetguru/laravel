@foreach($channels as $channel)
<tr>
    <td>{{$channel->id}}</td>
    <td><a href="{{$channel->image_url}}">{{$channel->image_url}}</a></td>
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
    <td><a href="/channel/update/{{$channel->id}}">edit</a> <a href="/channel/delete/{{$channel->id}}">delete</a> <br><a href="#" onclick="function(){$('html, body').animate({ scrollTop: 0 }, 'fast');}">Top Of Page</a></td>
</tr>
@endforeach