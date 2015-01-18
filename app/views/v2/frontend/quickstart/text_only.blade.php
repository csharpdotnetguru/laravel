@extends('layout.v2.home')

@section('title', ' | Quickstart')

@section('content')

<div class="container main-content my-account console-links">
    <section>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 page-content">
                <div>
                    <h3 class="page-header">Quickstart</h3>
                    <h5 class="status-check">Status Check...</h5>

                    <div class="col-md-6 col-sm-6">
                        <ul>
                            <li>
                                <a href="{{ route('dynamo_index') }}">Dynamo</a>
                            </li>
                            <li>
                                <a href="{{ route('network_index') }}">Networks</a>
                            </li>
                            <li>
                                <a href="{{ route('network_auto_update') }}">IP Update</a>
                            </li>
                            <li>
                                <a href="{{ route('dyndns_index') }}">DynDNS</a>
                            </li>
                            <li>
                                <a href="{{ route('all_channels') }}">Channels</a>
                            </li>
                            <li>
                                <a href="{{ route('all_devices') }}">Devices</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <ul>
                            <li>
                                <a href="{{ route('list_dns_servers') }}">Global Servers</a>
                            </li>
                            <li>
                                <a href="{{ route('my_account_index') }}">My Account</a>
                            </li>
                            <li>
                                <a href="http://help.unotelly.com/categories/4729/forums/290385">Channel Request</a>
                            </li>
                            <li>
                                <a href="http://help.unotelly.com">Knowledge Base</a>
                            </li>
                            <li>
                                <a href="http://help.unotelly.com/support/tickets/new">Help</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>
    </section>
</div>
<!-- /container -->

@include('v2.frontend.partials._footer')

@stop

@section('scripts')
<script>
    var dnsStatusApiLink = 'https://setupcheckapi.unotelly.com/index.php?callback=?&type=json';

    $(function() {
        $.getJSON(dnsStatusApiLink, function (dnsStatusResult) {
            // checking if proper object is returned
            if (typeof dnsStatusResult.dns_status !== false) {
                if (dnsStatusResult.dns_status === 'false') {
                    $('h5.status-check').html('<span class="incomplete">DNS Setup Incomplete.</span>');
                } else {
                    $('h5.status-check').html('<span class="complete">Everything is good.</span>');
                }
            }
        });
    });
</script>

@stop