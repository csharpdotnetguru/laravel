@foreach($reviewList as $review)
<tr>
    <td>{{$review->id}}</td>
    <td>{{$review->review}}</td>
    <td>{{$review->type}}</td>
    <td class="clickable" data-index={{$review->id}} onclick="edit_old(this)">Edit</td>
</tr>
@endforeach