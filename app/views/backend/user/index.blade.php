

<table>
	<tr>
		<th>UID</th>
		<th>F.Name</th>
		<th>L.Name</th>
		<th>E-mail</th>
	</tr>

@foreach($users as $user)
	<tr>
		<td>{{ $user->id }}</td>
		<td>{{ $user->firstname }}</td>
		<td>{{ $user->lastname }}</td>
		<td>{{ $user->email }}</td>
		<td></td>
	</tr>
@endforeach

</table>

{{ $users->links() }}