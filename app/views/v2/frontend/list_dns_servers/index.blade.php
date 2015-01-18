@extends('layout.v2.home')

@section('stylesheets')
{{ HTML::style('assets/v2/css/list-dns-servers.css') }}
{{ HTML::style('assets/v2/lib/jvector_map/jquery-jvectormap-1.2.2.css') }}
@stop

@section('content')

<div class="container main-content">
    @include('v2.frontend.partials._back-button')

    <header>
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1 page-title page-header">
                <h1>You are in {{ $user_city }}
                    <small>IP Address: {{ $user_ip }}</small>
                </h1>
            </div>
        </div>
    </header>

    <section>
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1 page-content">

                <h3 class="text-center no-space">Fastest Servers</h3>

                <br />

                <div class="table-responsive">
                    <table class="fastest-servers">
                        <tr>
                            <th>Primary DNS ({{ $primary['server_city'] }})</th>
                            <td><input type="text" class="dns-value" value="{{ $primary['server_ip'] }}"/></td>
                            <td>~ {{ $primary['distance'] }} km away from you</td>
                        </tr>
                        <tr>
                            <th>Secondary DNS ({{ $secondary['server_city'] }})</th>
                            <td><input type="text" class="dns-value" value="{{ $secondary['server_ip'] }}"/></td>
                            <td>~ {{ $secondary['distance'] }} km away from you</td>
                        </tr>
                    </table>
                </div>

                <hr />
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-xs-12  page-content">
                <div id="dns-world-map"></div>
            </div>
        </div>
    </section>

    <section>
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1 page-content">
                <h3>Our UnoDNS Servers</h3>

                <div class="table-responsive">
                    <table class="table table-hover">
                        <th>Server City</th>
                        <th>Server Country</th>
                        <th>Server IP</th>
                        <th>Dynamo Enabled</th>
                        <th>Distance from you</th>


                        @foreach($servers as $server)
                        <tr>
                            <td>{{ $server['server_city'] }}</td>
                            <td>{{ $server['server_country'] }}</td>
                            <td>{{ $server['server_ip'] }}</td>
                            <td>{{ ucfirst($server['server_type']) }}</td>
                            <td>{{ $server['distance'] }}km</td>
                        </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
    </section>

</div>
@stop

@section('scripts')
{{ HTML::style('assets/v2/lib/jvector_map/jquery-jvectormap-1.2.2.css') }}

{{ HTML::script('assets/v2/lib/jvector_map/jquery-jvectormap-1.2.2.min.js') }}
{{ HTML::script('assets/v2/lib/jvector_map/jquery-jvectormap-world-mill-en.js') }}

<script type="text/javascript">
    $(function() {
        var markers = {{ $json }};

        $('#dns-world-map').vectorMap({
            map: 'world_mill_en',
            zoomOnScroll: false,
            scaleColors: ['#C8EEFF', '#0071A4'],
            normalizeFunction: 'polynomial',
            hoverOpacity: 0.7,
            hoverColor: true,
            markerStyle: {
                initial: {
                    fill: '#F8E23B',
                    stroke: '#383f47'
                }
            },
            backgroundColor: '#383f47',
            markers: markers
        });
    });
</script>
@stop