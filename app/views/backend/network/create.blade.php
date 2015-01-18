
{{ Form::open(['route' => ['admin_network_store', $uid], 'method' => 'POST']) }}


{{Form::label('Client IP')}}<br>
{{Form::input('text','client_ip')}}<br>

{{Form::label('IP Status')}}<br>
{{Form::input('text','ip_status')}}<br>

{{Form::label('IP Label')}}<br>
{{Form::input('text','ip_label')}}<br>

{{Form::input('submit','submit')}}

{{Form::close()}}