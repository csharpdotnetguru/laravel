@extends('layout.admin')
@section('headContent')
<script>
    var formUrl = "{{URL::route('domain_list_create')}}";
</script>
{{HTML::script('/assets/scripts/popup.js')}}
@stop

@section('content')

<nav class="dirtyMenu">
    <ul>
        <li onclick="create_new()">Create New Domain</li>
        <li>{{ link_to_route('domain_list_create', 'Create Domain Non JS')}}</li>
        <li onclick="refresh()">Refresh List</li>
    </ul>
</nav>

@include('partials.popup')
<div class="search">
    @include('backend.domain_list.searchbar')
</div>
<table class="dirtyTable tableList">
    <thead>
    <th>id</th>
    <th>domain</th>
    <th>type</th>
    </thead>
    <tbody>
    @include('backend.domain_list.table_body')
    </tbody>

</table>

{{ $domainList->links() }}
@stop


