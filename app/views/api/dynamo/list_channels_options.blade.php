@foreach ($channels_collect as $channel)
<div data-role='page' id='{{ $channel->code }}' class='{{ $channel->channel_id }}'>
	<div data-role='header'>
		<a href='#' data-role='none' data-rel='back'>
			<span class='back'></span>
		</a>

		<h2>{{ ucwords($channel->name) }}</h2> 
	</div>

	<div data-role='content'>

			<ul class='country_list' data-role='listview'>

				@foreach($channel->options as $option)
				<?php

					// echo "channel_id " . $channel->channel_id;
					if  (	isset($dyn_pref_collec->prefs[$channel->channel_id]) 
							&&
							$dyn_pref_collec->prefs[$channel->channel_id] == $option->country_id
						)
					{
							$user_pref_country_id = $dyn_pref_collec->prefs[$channel->channel_id];
							// echo "user's pref country_id " . $dyn_pref_collec->prefs[$channel->channel_id];
							// echo "<br />";
							// echo $option->country_id;
							echo "<li class='$channel->channel_id-$option->country_id active_country icon_list' data-icon='false' data-theme='f'> ";
					}
					else
					{
						echo "<li class='$channel->channel_id-$option->country_id  icon_list'  data-icon='false' data-theme='f'>";
					}
		
				?>
				
					<form data-transition='pop' id='{{ $channel->channel_id }}-{{ $option->country_id }}' method='POST' action='abc.php'>
					<input type='hidden' name='uid' value='{{ $user->user_id }}' />
					<input type='hidden' name='channel_id' value='{{ $channel->channel_id }}'/>
					<input type='hidden' name='country_id' value='{{ $option->country_id }}' />
					<input type='hidden' name='user_hash' value='{{ $user_hash }}' />

					</form>
					<a class='dynamo_submit' data-form-id='{{ $channel->channel_id }}-{{ $option->country_id }}' href="#">
						<img src='http://quickstart3.unotelly.com/assets/images/flags/{{ $option->country_code}}.png' class='ui-li-icon ui-corner-none ui-li-thumb'>
						{{ ucwords($option->country_name) }}

					<span class='dynamo_country_active'></span>

					</a>


				</li>
				@endforeach

			</ul>

	</div>
</div>
@endforeach