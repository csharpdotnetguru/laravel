@extends('layout.admin')
@section('headContent')
<script>
    var formUrl = "{{URL::route('review_create')}}";
</script>
{{HTML::script('/assets/scripts/popup.js')}}

@stop

@section('content')

<nav class="dirtyMenu">
    <ul>
        <li onclick="create_new()">Create New Review</li>
        <li>{{ link_to_route('review_create', 'Create Review Non JS',null,['target'=>'_blank']) }}</li>
        <li onclick="refresh()">Refresh List</li>
    </ul>
</nav>
@include('partials.popup')
<div class="search">
@include('backend.review.searchbar')
</div>
<table class="dirtyTable tableList">
    <thead>
        <th>id</th>
        <th>Url</th>
        <th>Author</th>
        <th>Snippet</th>
        <th>domain</th>
        <th>image</th>
        <th>Blog Name</th>
    </thead>
    <tbody>
    @include('backend.review.table_body')
    </tbody>
</table>
{{ $reviews->links() }}
@stop


