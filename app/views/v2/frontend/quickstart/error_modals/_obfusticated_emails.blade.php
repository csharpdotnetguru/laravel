@if(!empty($obfusticated_emails))
	<p>Your IP is associated with the following accounts: </p>
	<ul class='list-unstyled'>
		@foreach($obfusticated_emails as $obfusticated_email)
		<li>{{ $obfusticated_email }}</li>
		@endforeach
	</ul>
	<p>Please contact support.</p>
@endif