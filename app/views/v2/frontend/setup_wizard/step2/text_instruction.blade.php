<table>
	<th>Device Name</th>
	<th>Device Code</th>
	<th>Device Type</th>
	<th>Device Link</th>
	<th>Video Link</th>

	<tr>
		<td>{{ $device_object->name }}</td>
		<td>{{ $device_object->device_code }}</td>
		<td>{{ $device_object->type }}</td>
		<td>{{ $device_object->link }}</td>
		<td>{{ $device_object->youtube_url }}</td>
	</tr>
</table>

<h2>Useful Articles</h2>
<ul>
@foreach($device_object->useful_tips_articles as $article)
	<a href="{{ $article->article_url }}"><li>{{ $article->article_name }}</li></a>
@endforeach
</ul>


<h2>Supported Channels</h2>
<ul>
@foreach($device_object->supported_channels as $channel)
	<a href="{{ $channel->url }}"><li>{{ $channel->name }}</li></a>
@endforeach
</ul>