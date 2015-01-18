{{ Form::open(['route' => ['admin_network_update', 'id'=>$network->id],'method' => 'put' ] ) }}

{{Form::label('User id')}}<br>
{{Form::text('user_id',$network->user_id)}}<br>

{{Form::label('Client IP')}}<br>
{{Form::text('client_ip',$network->client_ip) }}<br>

{{Form::label('IP Status')}}<br>
{{Form::text('ip_status',$network->ip_status) }}<br>

{{Form::label('IP Label')}}<br>
{{Form::text('ip_label',$network->ip_label) }}<br>

{{Form::input('submit','submit')}}

{{Form::close()}}