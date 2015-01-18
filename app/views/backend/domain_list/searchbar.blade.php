{{Form::open(['route'=>'domain_list_search','method'=>'POST','id'=>'domain_list_search'])}}
{{Form::text('search')}}
{{Form::input('submit',null,'Search')}}
{{Form::close()}}