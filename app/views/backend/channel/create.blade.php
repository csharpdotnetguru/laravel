{{Form::open(['route'=>'channel_store','method'=>'post'])}}

{{Form::label('Image Url')}}<br>
{{Form::input('text','image_url')}}<br>

{{Form::label('Channel Url')}}<br>
{{Form::input('text','channel_url')}}<br>

{{Form::label('Description')}}<br>
{{Form::textarea('description')}}<br>

{{Form::label('Type')}}<br>
{{Form::input('text','type')}}<br>

{{Form::label('Display')}}<br>
{{Form::input('text','display')}}<br>

{{Form::label('Competitor')}}<br>
{{Form::input('text','competitor')}}<br>

{{Form::label('Premium')}}<br>
{{Form::input('text','premium')}}<br>

{{Form::label('Gold')}}<br>
{{Form::input('text','gold')}}<br>

{{Form::label('Display Order')}}<br>
{{Form::input('text','display_order')}}<br>

{{Form::label('Name')}}<br>
{{Form::input('text','name')}}<br>

{{Form::label('Comment')}}<br>
{{Form::textarea('comment')}}<br>

{{Form::input('submit','submit')}}

{{Form::close()}}