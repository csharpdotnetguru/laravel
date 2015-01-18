@extends('layout.master')
@section('content')

<nav class="dirtyMenu">
    <ul>
        <li onclick="create_new()">Create New Domain</li>
        <li onclick="refresh()">Refresh List</li>
    </ul>
</nav>

@include('partials.popup')
@include('review.searchbar')
<table class="dirtyTable">
    <thead>
    <th>id</th><th>domain</th><th>type</th>
    </thead>
    <tbody>
    @include('review.table_body')
    </tbody>

</table>
@stop


