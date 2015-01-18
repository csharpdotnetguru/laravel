@extends('layout.admin')
@section('headContent')

<script>
    var formUrl = "{{URL::route('channel_create')}}";
</script>
{{HTML::script('/assets/scripts/popup.js')}}
@stop

@section('content')
<nav class="dirtyMenu">
    <ul>
        <li onclick="create_new()">Create New Channel test</li>
        <li>{{ link_to_route('channel_create', 'Create Channel Non JS') }}</li>
        <li onclick="refresh()">Refresh List</li>
    </ul>
</nav>

@include('partials.popup')
<div class="search">
    @include('backend.channel.searchbar')
</div>
<table class="dirtyTable tableList">
    <thead>
    <th>id</th>
    <th>image url</th>
    <th>channel url</th>
    <th>description</th>
    <th>type</th>
    <th>display</th>
    <th>competitor</th>
    <th>premium</th>

    <th>gold</th>
    <th>display order</th>
    <th>name</th>
    <th>comment</th>
    <th>Edit/Update</th>
    </thead>
    <tbody>
    @include('backend.channel.table_body')
    </tbody>

</table>
{{ $channels->links() }}
@stop


