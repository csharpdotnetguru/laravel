{{ Form::open([ 'route' => [ 'channel_update', $channel->id ], 'method' => 'put' ]) }}


{{Form::label('Image Url')}}<br>
{{Form::text('image_url',$channel->image_url)}}<br>

{{Form::label('Channel Url')}}<br>
{{Form::text('Channel Url',$channel->channel_url) }}<br>

{{ Form::label('Description') }} <br>
{{ Form::textarea('description',$channel->description)}}<br>

{{Form::label('Type')}}<br>
{{Form::text('type',$channel->type)}}<br>

{{Form::label('Display')}}<br>
{{Form::text('display',$channel->display)}}<br>

{{Form::label('Competitor')}}<br>
{{Form::text('competitor',$channel->competitor)}}<br>

{{Form::label('Premium')}}<br>
{{Form::text('premium',$channel->premium)}}<br>

{{Form::label('Gold')}}<br>
{{Form::text('gold',$channel->gold)}}<br>

{{Form::label('Display Order')}}<br>
{{Form::text('display_order',$channel->display_order)}}<br>

{{Form::label('Name')}}<br>
{{Form::text('name',$channel->name)}}<br>

{{Form::label('Comment')}}<br>
{{Form::textarea('comment',$channel->comment)}}<br>

{{Form::input('submit','submit')}}

{{Form::close()}}