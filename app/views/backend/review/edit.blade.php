{{ Form::open(['route'=>'review_update','method'=>'put']) }}

{{ Form::hidden('id',$review->id) }}

{{Form::label('Url')}}<br>
{{Form::text('url',$review->url)}}<br>

{{Form::label('Author')}}<br>
{{Form::text('author',$review->author) }}<br>

{{Form::label('Snipper')}}<br>
{{Form::textarea('snippet',$review->snippet) }}<br>

{{Form::label('Domain')}}<br>
{{Form::text('domain',$review->domain) }}<br>

{{Form::label('Image Url')}}<br>
{{Form::text('image',$review->image) }}<br>

{{Form::label('Blog Name')}}<br>
{{Form::text('blog_name',$review->blog_name) }}<br>

{{Form::input('submit','submit')}}

{{Form::close()}}