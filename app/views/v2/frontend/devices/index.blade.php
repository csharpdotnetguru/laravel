@extends('layout.v2.home')

@section('stylesheets')
    {{ HTML::style('assets/v2/css/_device-page.css') }}
    @include('v2.frontend.partials._grid-page-common-css')
@stop

@section('title', ' | Devices')

@section('content')

<div class="remodal device" data-remodal-id="modal" data-remodal-options='{ "hashTracking": false }'> <!-- Content to be insert via Ajax --> </div>

<div>
    <div id="Container" class="container main-content">
        @include('v2.frontend.partials._back-button')
        <header>

            <div class="row">
                <div class="col-xs-11 page-title page-header ">
                    <h1>Devices
                        <small>Choose a device below to view setup instruction</a></small>
                    </h1>
                </div>
            </div>
        </header>
        <div class="row">
            <div class="col-sm-11 col-sm-offset-1">
                <div id="item-filter-bar">
                    <ul class="item-filter-buttons">
                        <li class="filter item-filter-buttons" data-filter="all">Show All</li>
                        <li class="filter item-filter-buttons" data-filter=".pc">Computer</li>
                        <li class="filter item-filter-buttons" data-filter=".mobile">Mobile</li>
                        <li class="filter item-filter-buttons" data-filter=".gaming">Gaming</li>
                        <li class="filter item-filter-buttons" data-filter=".home">Home</li>
                        <li class="filter item-filter-buttons" data-filter=".router">Routers</li>
                        <input id="search_input" class="list_live_search" placeholder="Search Device">
                    </ul>
                </div>
            </div>
        </div>

        <!-- Beginning Device Listing Block -->
        <div class="devices">
            <ul id="og-grid" class="og-grid">

                @foreach ($all_devices as $device)

                <li class="mix item-border {{ strtolower($device->type) }}" data-myorder="3">

                    <a href="#" class="modal-button" data-item-id="{{ $device->device_code }}" data-modal-click-id="modal">

                        <img src="https://s3.amazonaws.com/assets.unotelly.com/images/devices/200/{{ $device->device_code }}.png" height="200" width="200" alt="img01"/>
                        <b>{{ $device->name }}</b>

                    </a>
                </li>
                @endforeach

            </ul>
        </div>
        <!-- Ending Device Listing Block -->

    </div>
    <!-- /container -->

</div>

@include('v2.frontend.partials._footer')

@stop

@section('scripts')

    @include('v2.frontend.partials._grid-page-common-js')

    <script type="text/javascript">
        $(function () {

            // when opening modal, apply anchor
            $('li.mix a').click(function() {
                var device = $(this).data('item-id');
                location.hash = 'device-' + device;
            });

            // when switching filter, apply anchor
            $('#item-filter-bar li.filter').click(function() {
                var filter = $(this).data('filter').replace('.', '');
                location.hash = filter;
            });

            // if has anchor, select related filter or channel
            var hash = location.hash.replace('#','');
            if (hash != '') {
                // looking for "device-" in the anchor
                // meaning it's a modal anchor
                if (hash.indexOf('device-') !== -1) {
                    var device = hash.replace('device-', '');

                    // TODO: find out why we need this
                    setTimeout(function() {
                        $("#og-grid a[data-item-id='" + device + "']").click();
                    }, 1);

                } else {
                    // else, it means it's a filter anchor
                    $("#item-filter-bar li[data-filter='." + hash + "']").click();
                }

            }

            // Initailize Modal
            var itemUrl = "{{ route('get_device_modal')}}";
            itemModal.click(itemUrl);

            $("#search_input").fastLiveFilter("#og-grid");
        });
    </script>

@stop
