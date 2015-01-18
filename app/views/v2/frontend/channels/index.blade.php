@extends('layout.v2.home')

@section('stylesheets')
	<!-- Grid-Page-Common-CSS -->
	@include('v2.frontend.partials._grid-page-common-css')
	<!-- End of Grid-page-common-css -->
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/v2/css/_channel-page.css') }}" />
@stop

@section('title', ' | Channels')

@section('content')

<div class="remodal channel" data-remodal-id="modal" data-remodal-options='{ "hashTracking": false }'> <!-- Content to be insert via Ajax --> </div>

<div id="full_page_container">

    <div class="row">
        <div class="col-sm-12 hidden-xs">
            <div class="channel-counter-banner container">
                <h1>Unlocked Channels: <span id="channel_count"> </span></h1>
            </div>
        </div>
    </div>

    <div id="Container" class="container">

        <div class="row">
            <div class="col-sm-12">
                @include('v2.frontend.partials._back-button')

                <div id="item-filter-bar">
                    <ul class="item-filter-buttons">
                        <li class="filter item-filter-buttons" data-filter="all">Show All</li>
                        @if(Authenticate::is_logged_in())
                        <li class="filter item-filter-buttons" data-filter=".favourites">My Favourites</li>
                        @endif
                        <li class="filter item-filter-buttons" data-filter=".videos">Videos</li>
                        <li class="filter item-filter-buttons" data-filter=".music">Music</li>
                        <li class="filter item-filter-buttons" data-filter=".sports">Sports</li>
                        <li class="filter item-filter-buttons" data-filter=".live_tv">Live TV</li>
                        <li class="filter item-filter-buttons" data-filter=".1">$$$</li>
                        <li class="item-search-channel">
                            <input id="search_input" class="list_live_search" placeholder="Search Channel">
                        </li>
                    </ul>

                </div>
            </div>
        </div>

        <!-- Beginning Device Listing Block -->
        <div class="devices">
            <ul id="og-grid" class="og-grid">

                @foreach ($all_channels as $channel)
                <li class="mix item-border {{ strtolower($channel->genre) }} {{ $channel->subscription }} @if(Authenticate::is_logged_in() && $channel->is_favourited()) favourites @endif" data-myorder="3">
                    <a href="#" class="modal-button" data-item-id="{{ $channel->channel_code }}" data-modal-click-id="modal">
                        <img src="https://s3.amazonaws.com/assets.unotelly.com/images/channels/200/{{ $channel->channel_code . '.png'}}" height="200" width="200" alt="img01"/>
                        <p class="channel_name"><b>{{ ucfirst($channel->name) }}</b></p>
                    </a>
                </li>
                @endforeach

            </ul>
        </div>
        <!-- Ending Device Listing Block -->

    </div>
    <!-- /container -->

</div>

@stop

@section('scripts')
    <!--Page Grid Page Common JS Assets !-->
    @include('v2.frontend.partials._grid-page-common-js')
    <!-- End of Grid Page Common JS Assets -->

    <script src="https://quickstart3.unotelly.com/assets/countUp/countUp.js"></script>

    <script type="text/javascript">
        $(function() {

            // when opening modal, apply anchor
            $('li.mix a').click(function() {
                var channel_code = $(this).data('item-id');
                location.hash = 'channel-' + channel_code;
            });

            // when switching filter, apply anchor
            $('#item-filter-bar li.filter').click(function() {
                var filter = $(this).data('filter').replace('.', '');
                location.hash = filter;
            });

            // if has anchor, select related filter or channel
            var hash = location.hash.replace('#','');
            if (hash != '') {
                // looking for "channel-" in the anchor
                // meaning it's a modal anchor
                if (hash.indexOf('channel-') !== -1) {
                    var channel_code = hash.replace('channel-', '');

                    // TODO: find out why we need this
                    setTimeout(function() {
                        $("#og-grid a[data-item-id='" + channel_code + "']").click();
                    }, 1);

                } else {
                    // else, it means it's a filter anchor
                    $("#item-filter-bar li[data-filter='." + hash + "']").click();
                }

            }


            // Channel count
            $.getJSON("{{ route('channel_count') }}", function(data) {
                var numAnim = new countUp("channel_count", 0, data, 0, 12);
                numAnim.start();
            });

            // Initailize Modal
            var itemUrl = '{{ route('get_channel_modal') }}';
            itemModal.click(itemUrl);

            // search live filter
            $('#search_input').fastLiveFilter('#og-grid');
        });

    </script>
    <!-- End of Page specific JS Assets -->
@stop
