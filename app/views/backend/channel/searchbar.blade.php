{{Form::open(['route'=>'channel_search','method'=>'POST','id'=>'channel_search'])}}
{{Form::text('search')}}
{{Form::input('submit',null,'Search')}}
{{Form::close()}}