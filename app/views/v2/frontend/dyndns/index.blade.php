@extends('layout.v2.home')

@section('title', ' | DynDNS')

@section('content')

<div class="container main-content">
    @include('v2.frontend.partials._back-button')
    <section>
        <div class="row">
            <div class="col-xs-12">
                <h1>DynDNS</h1>
                @include('partials._notification')

                <p>
                    To update your IP address using DynDNS, please add your DynDNS hostname. Your IP address will updated to your active UnoDNS network.
                </p>

                <p><h5>How to setup DynDNS:</h5>
                <a href="http://help.unotelly.com/solution/categories/27360/folders/43940/articles/159913-automatic-ip-update-using-dyndns">http://help.unotelly.com/solution/categories/27360/folders/43940/articles/159913-automatic-ip-update-using-dyndns</a></p>

                <br/>

                <p>
                    {{ link_to_route('dyndns_create', "Add hostname",[],['class'=>'btn btn-primary'] ) }}
                </p>

                <br/>

                @if(!empty($dyndns[0]))
                <table class="table table-hover">
                    <tr>
                        <th>Hostname</th>
                        <th></th>
                        <th></th>
                    </tr>
                    @foreach($dyndns as $row)
                    <tr>
                        <td>{{ $row->hostname }}</td>
                        <td>{{ link_to_route('dyndns_edit', "Edit",[$row->id],['class'=>'btn btn-info'] ) }}</td>
                        <td>
                            {{ Form::open(['route' => ['dyndns_destroy', $row->id], 'method' => 'DELETE']) }}
                            {{ Form::hidden('dyndns_id', $row->id) }}
                            {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                            {{ Form::close() }}

                        </td>
                    </tr>
                    @endforeach
                </table>
                @endif
            </div>
        </div>
    </section>
</div>

@include('v2.frontend.partials._footer')

@stop