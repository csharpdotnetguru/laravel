{{Form::open(['route'=>'admin_network_search','method'=>'POST','id'=>'channel_search'])}}
{{Form::text('search')}}
{{Form::input('submit',null,'Search')}}
{{Form::close()}}