{{Form::open(['route'=>'review_create','method'=>'post'])}}

{{Form::label('url')}}<br>
{{Form::input('text','url')}}<br>

{{Form::label('Author')}}<br>
{{Form::input('text','author')}}<br>

{{Form::label('Snippet')}}<br>
{{Form::textarea('snippet')}}<br>

{{Form::label('Domain Name')}}<br>
{{Form::input('text','domain')}}<br>

{{Form::label('Image Url')}}<br>
{{Form::input('text','image')}}<br>

{{Form::label('Blog Name')}}<br>
{{Form::input('text','blog_name')}}<br>

{{Form::input('submit','submit')}}

{{Form::close()}}