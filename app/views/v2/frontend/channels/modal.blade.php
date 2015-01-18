{{  HTML::style('assets/v2/css/_modal-channel.css') }}

<header>
    <div class="row header">
        <div class="col-sm-12 close-button">
            @include('v2.frontend.partials._back-button')
        </div>
    </div>
</header>

<section>

    <div class="row main-section-modal-channel">

        <div class="col-sm-6 left channel-logo hidden-s hidden-xs">
            <div class="row">
                <a target="_blank" href="http://www.nullrefer.com/?{{ $channel_object->channel_url }}">
                    <div class="col-sm-12 channel-logo">
                        <img src="https://s3.amazonaws.com/assets.unotelly.com/images/channels/600/{{$channel_object->channel_code . '.png'}}" class="center-block img-responsive" alt="Responsive image" width="400">
                        <p>Visit Channel</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="col-sm-6 right channel-info">
            <div class="row">
                <div class="col-sm-12 channel-text">
                    <h1 class="channel-title">
                        @if(Authenticate::is_logged_in())
                        <a class="mark-favourite" href="#"><i class="glyphicon @if($is_favourited) glyphicon-star @else glyphicon-star-empty @endif"></i></a>
                        @endif
                        <a class="channel-title" href="http://www.nullrefer.com/?{{ $channel_object->channel_url }}">{{ ucfirst($channel_object->name) }}</a>
                        <a href="http://help.unotelly.com/support/tickets/new">
                            <small class="report_button">Report an issue</small>
                        </a>
                    </h1>

                    <p>{{ $channel_object->comments }}</p>

                </div>
            </div>

            @if($channel_object->subscription == 1)

            <div class="row">
                <div class="col-sm-12 channel-dynamo-region">
                    <p>
                        <img src="{{ asset('assets/v2/images/icons/Money-Coin-128.png') }}" height="25" />
                        This channel might require additional subscription from the channel provider.
                    </p>
                </div>
                </a>
            </div>
            <hr>

            @endif

            @if(!empty($channel_object->dynamo_country))
            <div class="row">
                <div class="col-sm-12 channel-dynamo-region">
                    <h4 class="sub_title">Dynamo Regions:</h4>

                    <a href="{{ route('dynamo_index') }}">
                        <ul class="dynamo">
                            @foreach($dyn_countries_array as $country)
                            <li class="dynamo">
                                <img class="country-flag" src="{{ asset('assets/v2/images/flags/32') }}/{{ trim($country) }}.png">
                            </li>
                            @endforeach
                        </ul>
                    </a>
                </div>
            </div>
            <hr>
            @endif

            @if(!empty($channel_object->useful_tips_articles->first()))
            <div class="row">
                <div class="col-sm-8 channel-tips">
                    <h4 class="sub_title">Useful Tips:
                        <h4>
                            <ul class="tips">

                                @foreach($channel_object->useful_tips_articles as $article)
                                <a href="{{ $article->article_url }}">
                                    <li class="tips">{{ $article->article_name }}</li>
                                </a>
                                @endforeach

                                <p><a href="{{ $channel_object->article_folder_url }}">... More </a></p>

                            </ul>
                        </h4>
                    </h4>
                </div>
            </div>
            <hr>
            @endif

            <div class="row">
                <div class="col-sm-12 channel-devices">
                    <h4 class="sub_title">Supported Devices:
                        <h4>
                            <ul class="list-inline">
                                @foreach($channel_object->supported_devices as $device)
                                <li>
                                    <small>{{ $device->name }}</small>
                                </li>
                                |
                                @endforeach
                            </ul>
                        </h4>
                    </h4>
                </div>
            </div>

        </div>

    </div>

</section>

@if(Authenticate::is_logged_in())
<script>
    var uri = '{{ URL::route('channels_mark_favourite', ['channel_code' => $channel_object->channel_code]) }}';

    $(function() {

        $('.mark-favourite').click(function() {
            var that = this;

            $.post(uri, function(response) {
                // checking if success property exists, and checks if success
                if ((typeof response.success !== false) && (response.success)) {
                    if (response.is_favourited) {
                        $(that).find('i').removeClass('glyphicon-star-empty').addClass('glyphicon-star');
                    } else {
                        $(that).find('i').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                    }

                    // toggling class "favourites" to update the favourites filter
                    $("a[data-item-id='{{ $channel_object->channel_code }}']").parent().toggleClass('favourites');

                    alertify.success('Favourite channels saved successfully.');
                } else {
                    alertify.error('Something wrong happened, please try again.');
                }
            });

            return false;
        });

    });
</script>
@endif