{{Form::open(['route'=>'review_search','method'=>'POST','id'=>'review_search'])}}
{{Form::text('search')}}
{{Form::input('submit',null,'Search')}}
{{Form::close()}}