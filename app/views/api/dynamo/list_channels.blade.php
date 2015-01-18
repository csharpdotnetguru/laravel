@foreach($channels_collect as $channel) 
<li data-icon='false'>
	<a href="#{{ $channel->code }}" data-transition='slide'>{{ ucfirst($channel->name) }}


	<span class='li_go_dark'></span>

	</a>
</li>
@endforeach