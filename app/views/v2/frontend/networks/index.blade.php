@extends('layout.v2.home')

@section('stylesheets')
	{{  HTML::style('assets/css/style.css') }}
@stop

@section('title', ' | Networks')

@section('content')
		<?php
		$index = 0;
		?>
<div class="container main-content">

    @include('v2.frontend.partials._back-button')
    <h1>Networks</h1>

    @include('partials._notification')

<section>

@if(!empty($networks[0]))

<div class="table-responsive">

    <table class='table table-hover'>
        <tr>
            <!--<th>ID</th>-->
            <th>Network Name</th>
            <!--<th>Network Owner</th>-->
            <th>IP Address</th>
            <th>IP Status</th>
            <!--<th>Created at</th>-->
            <!--<th>Last modified</th>-->
            <th></th>
            <th></th>
            <th></th>
        </tr>

        @foreach($networks as $network)
        <?php if ($network->ip_status == 0) {
            $toggle_name = "Enable";
            $btn_status = "btn-danger";
            $status_light = "status_light_red";
        } else {
            $toggle_name = "Enable";
            $btn_status = "btn-success";
            $status_light = "status_light_green";
        }
        ?>
        <tr>
            <!--<td>{{ $network->id }}</td>-->
            <td>{{ $network->ip_label }}</td>
            <!--<td>{{ $network->user_id }}</td>-->
            <td>{{ $network->client_ip }}</td>
            <td>
                <div class="{{$status_light}}">
                    {{Form::hidden('ip_status',$network->ip_status)}}
                </div>
            </td>
            <!--<td>{{ $network->created_at }}</td>-->
            <!--<td>{{ $network->updated_at }}</td>-->
            <td>
                <!-- Removed uid parameter -->
                {{ Form::open(['route' => ['network_toggle', $network->id], 'method' => 'PUT']) }}
                {{ Form::hidden('network_id', $network->id) }}
                @if($network->ip_status==0)
                {{ Form::submit($toggle_name, ['class' => 'btn']) }}
                @else
                {{ Form::submit($toggle_name, ['class' => 'btn','disabled'=>true]) }}
                @endif
                {{ Form::close() }}
            </td>
            <td>
                <!-- Removed uid parameter -->
                {{ link_to_route('network_edit', "Edit",[$network->id],['class'=>'btn btn-info'] ) }}
            </td>
            <td>
                <!-- Removed uid parameter -->
                {{ Form::open(['route' => ['network_destroy', $network->id], 'method' => 'DELETE']) }}
                {{ Form::hidden('network_id', $network->id) }}
                {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                {{ Form::close() }}
            </td>

        </tr>
        @endforeach

    </table>
</div>
@else
<h2>No network</h2>
@endif

    <hr/>

    <div class="row">
        <div class="col-sm-6">
            @include('v2.frontend.networks.partials._create')
        </div>
        <div class="col-sm-6">
            @include('v2.frontend.networks.partials._update')
        </div>
    </div>


    </section>

</div>

@include('v2.frontend.partials._footer')

	@section('scripts')
		<script>
	        var dynamoIndex='{{URL::route('dynamo_index',['uid'=>Authenticate::get_uid()])}}';
	        var dynamoUpdate='{{URL::route('dynamo_update',['uid'=>Authenticate::get_uid()])}}';
	        var updateAjax='{{URL::route('updateAjax',['uid'=>Authenticate::get_uid()])}}';
		</script>

	    {{  HTML::script('assets/scripts/script.js')  }}

	@stop
@stop