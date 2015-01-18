{{Form::open(['route'=>'admin_authenticate','method'=>'post'])}}

{{Form::label('email')}}<br>
{{Form::text('email')}}<br>
<br>
{{Form::label('password')}}<br>
{{Form::password('password')}}<br><br>
{{Form::input('submit',null,"Login")}}
{{Form::close()}}