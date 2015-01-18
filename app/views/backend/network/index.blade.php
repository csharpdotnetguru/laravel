@extends('layout.admin')
@section('headContent')
<script>
    var formUrl = "{{URL::route('admin_network_create')}}";
</script>
{{HTML::script('/assets/scripts/popup.js')}}

@stop

@section('content')

<nav class="dirtyMenu">
    <ul>
        <li onclick="create_new()">Create New Network</li>
        <li>{{link_to_route('admin_network_create','Create Network Non JS') }}</li>
        <li onclick="refresh()" >Refresh List</li>
    </ul>
</nav>

@include('partials.popup')
<div class="search">
    @include('backend.network.searchbar')
</div>
{{Form::open(['route'=>'admin_network_delete','method'=>'delete'])}}
<table class="dirtyTable tableList" >
    <thead>
    <th>select to delete</th><th>id</th><th>User Id</th><th>Client IP</th><th>IP Status</th><th>IP Label</th>
    </thead>
    <tbody>
    @include('backend.network.table_body')
    </tbody>

</table>
<br>
{{Form::submit('Delete Selected')}}
{{Form::close()}}

{{ $networks->links() }}
@stop


