@foreach($reviews as $review)
<tr>
    <td>{{$review->id}}</td>
    <td><a href="{{$review->url}}">{{$review->url}}</a></td>
    <td>{{$review->author}}</td>
    <td>{{$review->snippet}}</td>
    <td><a href="{{$review->domain}}">{{$review->domain}}</a></td>
    <td><a href="{{$review->image}}" target="_blank"><img src="{{$review->image}}"/></a></td>
    <td>{{$review->blog_name}}</td>
    <td class="clickable" data-edit-link="{{URL::route('review_edit',$review->id)}}" onclick="edit_old(this)">Edit</td>
</tr>
@endforeach