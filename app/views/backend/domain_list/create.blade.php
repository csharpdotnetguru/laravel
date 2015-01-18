{{Form::open(['route'=>'domain_list_store','method'=>'post'])}}

{{Form::label('domain')}}<br>
{{Form::input('text','domain')}}<br>

{{Form::label('type')}}<br>
{{Form::input('text','type')}}<br>

{{Form::input('submit','submit')}}

{{Form::close()}}