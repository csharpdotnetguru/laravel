{{ Form::open(['route' => ['admin_free_update', $uid], 'method' => 'PUT']) }}
<input type='date' name='expiry_time' />
{{ Form::submit('Extend Trial', ['class' => 'btn btn-primary']) }}
	
{{ Form::close() }}