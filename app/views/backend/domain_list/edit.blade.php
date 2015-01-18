{{ Form::open(['route'=>'domain_list_update','method'=>'put']) }}

{{ Form::hidden('id',$domain->id) }}

{{Form::label('Domain Name')}}<br>
{{Form::text('domain',$domain->domain)}}<br>

{{Form::label('Type')}}<br>
{{Form::text('type',$domain->type) }}<br>

{{Form::input('submit','submit')}}

{{Form::close()}}