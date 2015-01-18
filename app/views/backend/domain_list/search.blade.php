@extends('layout.master')
@section('headContent')
@stop

@section('content')

<nav class="dirtyMenu">
    <ul>
        <li onclick="create_new()">Create New Domain</li>
        <li onclick="refresh()">Refresh List</li>
    </ul>
</nav>

@include('partials.popup')
@include('backend.domain_list.searchbar')
<table class="dirtyTable">
    <thead>
    <th>id</th><th>domain</th><th>type</th>
    </thead>
    <tbody>
    @include('domain_list.table_body')
    </tbody>

</table>
@stop


