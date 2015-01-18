<link rel="stylesheet" href="{{ asset('assets/v2/css/_modal-device.css') }}">

<header>
    <div class="row header">
        <div class="col-sm-12 close-button">
            @include('v2.frontend.partials._back-button')
        </div>
    </div>
</header>

<section>

    <div class="row main-section-modal-device">

        @if( !empty($device_object->youtube_url) )
        <div class="col-sm-6 left youtube">
            <div class="row">
                <div class="col-sm-12 video">
                    <p class="center">
                        <iframe class="youtube" src="//www.youtube.com/embed/RPVdVKckyf4" frameborder="0" allowfullscreen></iframe>
                    </p>
        @else
        <div class="col-sm-6 left youtube hidden-s hidden-xs">
            <div class="row">
                <div class="col-sm-12 video">
                    <a href="{{ $device_object->link }}">
                        <img src="https://s3.amazonaws.com/assets.unotelly.com/images/devices/400/{{ $device_object->device_code }}.png" class="center-block img-responsive" width="450" alt="Responsive image">
                    </a>
        @endif

                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 view-text-instruction">
                    <h3 class="center">
                        <a href="{{ $device_object->link }}">
                            <img src="{{ asset('assets/v2/images/icons/Wrench-128.png') }}" height="35"/>
                            View Setup Instruction
                            <img src="{{ asset('assets/v2/images/icons/Wrench-128.png') }}" height="35"/>
                        </a>
                    </h3>
                </div>
            </div>

        </div>

        <div class="col-sm-6 right device-info">
            <div class="row">
                <div class="col-sm-12 device-text">
                    <div class="page-header">
                        <a class="device-title" href="{{ $device_object->link }}">
                            <h1>
                                {{ ucfirst($device_object->name) }}
                                <a href="http://help.unotelly.com/support/tickets/new">
                                    <small class="report_button">Report an issue</small>
                                </a>
                            </h1>
                        </a>
                    </div>

                    <p>{{ $device_object->comment }}</p>

                </div>
            </div>

            <div class="row">
                <a href="{{ $device_object->link }}">
                    <h4>
                        <img src="{{ asset('assets/v2/images/icons/Wrench-128.png') }}" height="35"/>
                        Click here for Setup Instruction
                        <img src="{{ asset('assets/v2/images/icons/Wrench-128.png') }}" height="35"/>
                    </h4>
                </a>
            </div>
            <hr>

            <div class="row">
                <div class="col-sm-12 device-dns-server">
                    <h4>Please use these as your DNS servers:</h4>
                    <h4 class="dns-server">Primary DNS: {{ $dns_servers[0]["server_ip"] }}</h4>
                    <h4 class="dns-server">Secondary DNS: {{ $dns_servers[1]["server_ip"] }}</h4>
                </div>
            </div>
            <hr>

            @if(! empty($device_object->useful_tips_articles->first()))
            <div class="row">
                <div class="col-sm-12 device-tips">
                    <h4 class="sub_title">Useful Tips:
                        <h4>
                            <ul class="tips">
                                @foreach($device_object->useful_tips_articles as $article)
                                <a href="{{ $article->article_url }}">
                                    <li class="tips">{{ $article->article_name }}</li>
                                </a>
                                @endforeach
                            </ul>
                            <p><a href="{{ $device_object->article_folder_url }}">... More </a></p>
                        </h4>
                    </h4>
                </div>
            </div>
            <hr>
            @endif

            <!-- 		<div class="row">
                        <div class="col-sm-12 device-channels">
                            <h4 class="sub_title">Supported Channels:<h4>
                                <ul class="list-inline">
                                @foreach($device_object->supported_channels as $channel)
                                    <li><small>{{ $channel->name }}</small></li> |
                                @endforeach
                                </ul>
                        </div>
                    </div> -->

        </div>
    </div>
</section>