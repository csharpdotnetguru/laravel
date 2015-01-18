{{Form::open(['route'=>'admin_store','method'=>'post'])}}

{{Form::label('email')}}<br>
{{Form::text('email',$email)}}<br>
<br>
{{Form::label('password')}}<br>
{{Form::password('password')}}<br><br>

{{Form::label('Confirm Password')}}<br>
{{Form::password('confirm_password')}}<br><br>
{{Form::input('submit',null,"Create Account")}}
{{Form::close()}}