<?php
	$uid = $user->id;
?>

<table>
	<tr>
		<th>ID</th>
		<th>F.Name</th>
		<th>L.Name</th>
		<th>E-mail</th>
		<th>User Hash</th>
		<th>API Calls</th>
		<th></th>
		<th></th>

	</tr>


	<td>{{ $user->id }}</td>
	<td>{{ $user->firstname }}</td>
	<td>{{ $user->lastname }}</td>
	<td>{{ $user->email }}</td>
	<td>{{ $user_hash->user_hash }}</td>
	<td>{{ $user_hash->api_calls }}</td>
	<td></td>

</table>

<h2>Subscriptions</h2>
<table>
	<tr>
		<th>ID</th>
		<th>Product Type</th>
		<th>Product Length</th>
		<th>Expiry Date</th>
	</tr>

@foreach($subs as $sub)
	<tr>
		<td>{{ $sub->id }}</td>
		<td>{{ $sub->productType }}</td>
		<td>{{ $sub->productLength }}</td>
		<td>{{ $sub->endTime }}</td>
	</tr>
@endforeach

<table>


<h2>Networks</h2>
{{ link_to_route('admin_network_create', 'Create network', $uid) }}
<table>
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>IP Address</th>
		<th>Status</th>
		<th></th>
		<th></th>
		<th></th>
	</tr>

@foreach($networks as $network)
	<tr>
		<td>{{ $network->id }}</td>
		<td>{{ $network->ip_label }}</td>
		<td>{{ $network->client_ip }}</td>
		<td>{{ $network->ip_status  }}</td>
		<td>
            {{ Form::open(['route' => ['admin_network_toggle', $network->user_id, $network->id], 'method' => 'PUT']) }}
            {{ Form::submit('Toggle', ['class' => 'btn']) }}
            {{ Form::close() }}
        </td>
		<td>{{ link_to_route('admin_network_edit','Edit', $network->id) }}</td>
		<td>
            {{ Form::open(['route' => ['admin_network_destroy', $network->user_id, $network->id], 'method' => 'DELETE']) }}
            {{ Form::submit('Delete', ['class' => 'btn']) }}
            {{ Form::close() }}			
		</td>
	</tr>
@endforeach

<table>


<h2>Trials</h2>
<table>
	<tr>
		<th>ID</th>
		<th>Start time</th>
		<th>Trial Length</th>
		<th>End Time</th>
		<th>Status</th>
		<th></th>
	</tr>

	<tr>
		<td>{{ $user_free->id }}</td>
		<td>{{ gmdate("Y-m-d H:i:s", $user_free->regTime )}}</td>
		<?php $trialLength = $user_free->trialLength/3600; ?>
		<td>{{ $trialLength }} hours</td>
		<td>{{ gmdate("Y-m-d H:i:s", $user_free->endTime )}}</td>
		<td>{{ $user_free->status  }}</td>
		<td>@include('backend.free/extend_trial')</td>
	</tr>

<table>