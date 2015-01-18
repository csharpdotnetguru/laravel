@extends('layout.admin')
@section('content')
<div class="search">
@include('backend.channel.searchbar')
</div>
<div class="detail_view" xmlns="http://www.w3.org/1999/html">


    <div class="detail_header">
    <span class="detail_id">
        {{$channel->id}}
    </span>
    <span>
        <a href="{{$channel->image_url}}">
            <img src="{{$channel->image_url}}"/>
        </a>
    </span>
    <span>
        <a href="{{$channel->channel_url}}">
            {{$channel->channel_url}}
        </a>
    </span>
    </div>
    <div class="detail_block">
        {{Form::label('Description')}}<br>
        {{$channel->description}}
    </div>

    <div class="detail_content">
        {{Form::label('type')}}<br>
        {{$channel->type}}
    </div>

    <div class="detail_content">
        {{Form::label('display')}}<br>
        {{$channel->display}}
    </div>

    <div class="detail_content">
        {{Form::label('competitor')}}<br>
        {{$channel->competitor}}
    </div>

    <div class="detail_content">
        {{Form::label('premium')}}<br>
        {{$channel->premium}}
    </div>

    <div class="detail_content">
        {{Form::label('gold')}}<br>
        {{$channel->gold}}
    </div>

    <div class="detail_content">
        {{Form::label('display order')}}<br>
        {{$channel->display_order}}
    </div>

    <div class="detail_content">
        {{Form::label('name')}}<br>
        {{$channel->name}}
    </div>
    <div class="detail_block">
        {{Form::label('comments')}}<br>
        {{$channel->comment}}
    </div>
</div>
@stop