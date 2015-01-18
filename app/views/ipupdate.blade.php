
<h1>IP Update API</h1>



{{ Form::open(['route' => ['ipupdate'], 'method' => 'POST']) }}
 
 <p>
{{ Form::label('uid', 'User ID') }}
{{ Form::text('uid') }}
</p>

 
 <p>
{{ Form::label('ip_address', 'IP Address') }}
{{ Form::text('ip_address') }}
</p>

 <p>
{{ Form::label('network_id', 'Network ID') }}
{{ Form::text('network_id') }}
</p>

<p> 
{{ Form::label('user_hash', 'User Hash') }}
{{ Form::text('user_hash') }}
</p>


{{ Form::submit('Update IP', array('class' => 'btn btn-primary')) }}

{{ Form::close() }}

