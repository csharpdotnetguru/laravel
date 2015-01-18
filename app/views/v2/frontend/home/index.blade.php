@extends('layout.v2.home')

@section('stylesheets')
{{ HTML::style('assets/v2/lib/fullPage/jquery.fullPage.css') }}
@stop

@section('content')

<div id="geoBlocks" class="section table geoBlocks container active">
    <div class="geoContent middle-content tableCell">
        <div class="home-heading has-shadow">Experience the Web without Virtual Borders</div>
        <div class="home-description has-shadow">UnoTelly unlocks TV, film & music not available in your current
            location.
        </div>

        <div class="button-container">
            <a href="{{ URL::route('user_create') }}" class="btn btn-custom-big btn-red has-box-shadow signup-button" >Try
                for Free</a>
            <!-- <a href="#" class="btn btn-custom-big btn-gray has-box-shadow"><img src="/assets/v2/images/front-play-icon.png"/>
                Watch Video</a> -->
        </div>
    </div>
</div>

<div id="channels" class="section channels">

<div class="section-heading">Countless Channels to Love</div>
<div class="section-description">Our catalogue is one of the largest around and grows everyday. Why settle for less when
    you can have more with UnoTelly?<br/>With 250+ channels, you’re bound to discover something new to watch and enjoy.
</div>

<div class="channels-list-container">
<div class="slider_container">
<ul class="slider1">
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-hbo.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-disney.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-netflex.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-abc.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-aertv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-cn.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-netflex.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-abc.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-aertv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-cn.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-mog.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-itv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-netflex.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-abc.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-aertv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-hbo.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-disney.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-netflex.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-abc.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-aertv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-cn.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-netflex.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-abc.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-aertv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-cn.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-mog.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-itv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-netflex.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-abc.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-aertv.png" class="channel-item-img"/>
    </li>
</ul>
<ul class="slider2">
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-disney.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-ng.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-mog.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-itv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-hbo.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-disney.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-ng.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-mog.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-itv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-hbo.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-disney.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-ng.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-mog.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-itv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-hbo.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-disney.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-ng.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-mog.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-itv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-hbo.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-disney.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-ng.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-mog.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-itv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-hbo.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-disney.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-ng.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-mog.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-itv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-hbo.png" class="channel-item-img"/>
    </li>
</ul>
<ul class="slider3">
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-hbo.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-disney.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-netflex.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-abc.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-aertv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-cn.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-netflex.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-abc.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-aertv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-cn.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-mog.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-itv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-netflex.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-abc.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-aertv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-hbo.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-disney.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-netflex.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-abc.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-aertv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-cn.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-netflex.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-abc.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-aertv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-cn.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-mog.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-itv.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-netflex.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-abc.png" class="channel-item-img"/>
    </li>
    <li class="item channel_slide">
        <img src="/assets/v2/images/channels-aertv.png" class="channel-item-img"/>
    </li>
</ul>

</div>

<div class="channels-button">
    <a href="{{ URL::route('all_channels') }}" class="btn btn-custom-small btn-red">Learn more</a>
</div>

</div>
</div>

<div class="devicesAndPlatforms section" id="devicesAndPlatforms">

    <div class="devices-wrapper">

        <div class="devices-top">
            <img src="/assets/v2/images/apple-tv.png" id="apple-tv"/>
            <img src="/assets/v2/images/apple-player.png" id="apple-player"/>
            <img src="/assets/v2/images/apple-phone.png" id="apple-phone"/>
        </div>

        <div class="content">
            <div class="section-heading has-shadow">Extensive Device and Platform Compatibility</div>
            <div class="section-description has-shadow">UnoTelly works on any PC/Mac/Linux, media streaming device, game
                console and mobile device.<br/>If you have it, we probably support it!
            </div>

            <div class="devices-button">
                <a href="{{ URL::route('all_devices') }}" class="btn btn-custom-small btn-red">Learn more</a>
            </div>
        </div>

        <div class="devices-down">
            <div class="devices-wrapper-down">
                <img src="/assets/v2/images/apple-game-station.png" id="apple-tv-down"/>
                <img src="/assets/v2/images/apple-pad.png" id="apple-player-down"/>
                <img src="/assets/v2/images/apple-joystick.png" id="apple-phone-down"/>
            </div>
        </div>

    </div>

</div>

<div class="unlimitedAccess section table" id="unlimitedAccess">
    <div class="access-container tableCell">
        <div class="access-info">
            <div class="section-heading has-shadow">Unlimited Access and Bandwidth</div>
            <div class="section-description has-shadow">
                <p>Whether you have one or one hundred, there is no limit on how many devices you can use with UnoTelly. </p>
            </div>

            <a href="{{ URL::route('all_channels') }}" class="btn btn-custom-small btn-red">Learn more</a>
        </div>

        <div class="col-xs-12">
            <div class="flow-chart">
                <div class="flow-center">UnoTelly</div>
            </div>
        </div>

    </div>
</div>

<div class="favoriteChannels table section" id="favoriteChannels">

    <div class="tableCell">
        <div class="section-heading has-shadow">Customize your Favorite Channel</div>
        <div class="section-description has-shadow">We make it easy to tailor your favorite channel to fit everyone's
            tastes.
        </div>

        <div class="favorite-channels-list container">
            <div class="row">
                <div class="col-xs-4 left item">
                    <div class="favorite-channel-list-container">
                        <img src="/assets/v2/images/favChannel-item-1.png" class="img"/>

                        <div>
                            <p class="name">Your fancy</p>

                            <p class="company">US Netflix</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4 top item">
                    <div class="favorite-channel-list-container">
                        <img src="/assets/v2/images/favChannel-item-2.png" class="img"/>

                        <div>
                            <p class="name">Your family prefers</p>

                            <p class="company">UK Netflix</p>
                        </div>
                    </div>
                </div>
                <div class="col-xs-4 right item">
                    <div class="favorite-channel-list-container">
                        <img src="/assets/v2/images/favChannel-item-3.png" class="img"/>

                        <div>
                            <p class="name">And your dog digs</p>

                            <p class="company">Canadian Netflix</p>
                        </div>
                    </div>
                </div>
            </div>
            <br/>

            <div class="section-description has-shadow">Now you can stream from up to three regions <strong>at the same
                    time</strong> using UnoTelly <span class="has-tooltip" title="Dynamo lets you change regions of your favourite channels. For example, you can choose between 14 Netflix regions and accees their unique contents by using Dynamo.">Dynamo</span>.
            </div>

            <a href="{{ URL::route('all_channels') }}" class="btn btn-custom-small btn-red">Learn more</a>
        </div>
    </div>
</div>

<div class="onDemand section table" id="onDemand">
    <div class="container tableCell">
        <div class="row">
            <div class="col-md-7">

                <div class="section-heading has-shadow">We care about your Experience</div>
                <div class="section-description has-shadow">From the very first moment you experience UnoTelly, our
                    friendly and dedicated support team are here to help you every step of the way.
                </div>

                <ul class="onDemands-items">
                    <li class="has-shadow">24/7 On-Demand Support</li>
                    <li class="has-shadow">Helpful advice and easy instructions</li>
                    <li class="has-shadow">98% Customer Satisfaction Rate</li>
                </ul>

                <h5 class="slogan has-shadow">Your satisfication is our number one priority!</h5>
                <!--                 <a href="{{ URL::route('faqs') }}" class="btn btn-custom-small btn-red">Learn more</a>
                 -->            </div>
        </div>
    </div>
</div>

<div id="speed" class="speed table section">
    <div class="content tableCell">
        <div class="speed-text">
            <div class="section-heading">Blazing Speed with DirectConnect</div>
            <div class="section-description">
                <p>We connect you straight to the source which means no middleman to slow down your connection. </p>

                <p>Now you can spend more time watching and less time buffering!</p>
            </div>

<!--             <a href="{{ URL::route('faqs') }}" class="btn btn-custom-small btn-red">Learn more</a>
 -->
        </div>
        <div class="speed-tester row">
            <div class="unotelly col-xs-12 col-sm-6">
                <img src="/assets/v2/images/speed.png"/>
                <img class="pointer1" src="/assets/v2/images/pointer.png"/>
                <h6 class="name-left">UnoTelly</h6>
            </div>
            <div class="competitor hidden-xs col-sm-6">
                <img src="/assets/v2/images/speed.png"/>
                <img class="pointer2" src="/assets/v2/images/pointer.png"/>
                <h6 class="name-right">Competitors</h6>
            </div>
        </div>
    </div>
</div>

<div id="map" class="map table section">
    <div class="map-text tableCell">
        <div class="section-heading has-shadow">Global Presence, Local Access</div>
        <div class="section-description has-shadow">When it's TV time, UnoTelly covers you on every continent.<br/>
            Our 30+ UnoDNS servers are geographically distributed across the world to maximize your speed and stability.<br/>
            No matter where you are, you will find a local UnoDNS server near you.
        </div>
        <a href="{{ URL::route('list_dns_servers') }}" class="btn btn-custom-small btn-red">Learn more</a>
    </div>
</div>

<div class="pricingPlans section table" id="pricingPlans">
    <div class="tableCell">
        <div class="content">
            <div class="section-heading has-shadow">Pricing Plans</div>

            <div class="ribbon">
                100% Moneyback Guarantee. No Contract.
            </div>

            <div class="pricing-container">

                <div class="premium">
                    <div class="premium-header">
                        <div class="offset"></div>
                        <div class="premium-box-rect"></div>
                        <h4 class="premium-title">PREMIUM PLAN</h4>
                    </div>
                    <p class="price"><strong>$4.95</strong>/MO</p>

                    <p class="description">
                        100% Unlimited <span class="" title="Lorem ipsum">UnoDNS</span> Access
                        <br/>
                        Over <span class="" title="Lorem ipsum">250+ channels</span> unlocked globally
                        <br/>
                        <span class="" title="Lorem ipsum">30+ fast DNS Servers</span>.
                        <br/>
                        24/7 Live Support
                        <br/>
                        7-days Moneyback Guarantee
                    </p>
                    <form action="{{ URL::route('user_create') }}">

                    <input  type="submit"  class="try-preminum-button" value="Try Premium" />
                    </form>
                </div>

                <div class="gold">
                    <img src="/assets/v2/images/gold-plan-ribbon.png"/>

                    <div class="gold-header">
                        <div class="offset"></div>
                        <div class="gold-box-rect"></div>
                        <h4 class="gold-title">GOLD PLAN</h4>
                    </div>
                    <p class="price"><strong>$7.95</strong>/MO</p>

                    <p class="description">
                        Everything on Premium Package PLUS
                        <br/>
                        <span class="" title="Lorem ipsum">UnoVPN</span> with <span class="" title="Lorem ipsum">PPTP</span> and <span class="" title="Lorem ipsum">OpenVPN</span> Protocol
                        <br/>
                        US, UK, Canada, Netherlands VPN servers
                        <br/>
                        <span class="" title="Lorem ipsum">Secured Servers</span> to prevent snooping and to protect your identity
                    </p>
                    <form action="https://www.unotelly.com/portal/cart.php?gid=5">
                        <input src='#' type="submit" class="try-gold-button" value="Buy Gold" data-toggle="modal" data-target=""/>
                    </form>
                </div>
            </div>
<!--             <div class="pricing-container">

                <div class="premium">
                    <div class="premium-header">
                        <div class="offset"></div>
                        <div class="premium-box-rect"></div>
                        <h4 class="premium-title">PREMIUM PLAN</h4>
                    </div>
                    <p class="price"><strong>$4.95</strong>/MO</p>

                    <p class="description">
                        100% Unlimited <span class="has-tooltip" title="Lorem ipsum">UnoDNS</span> Access
                        <br/>
                        Over <span class="has-tooltip" title="Lorem ipsum">250+ channels</span> unlocked globally
                        <br/>
                        <span class="has-tooltip" title="Lorem ipsum">30+ fast DNS Servers</span>.
                        <br/>
                        24/7 Live Support
                        <br/>
                        7-days Moneyback Guarantee
                    </p>
                    <form action="{{ URL::route('user_create') }}">

                    <input  type="submit"  class="try-preminum-button" value="Try Premium" />
                    </form>
                </div>

                <div class="gold">
                    <img src="/assets/v2/images/gold-plan-ribbon.png"/>

                    <div class="gold-header">
                        <div class="offset"></div>
                        <div class="gold-box-rect"></div>
                        <h4 class="gold-title">GOLD PLAN</h4>
                    </div>
                    <p class="price"><strong>$7.95</strong>/MO</p>

                    <p class="description">
                        Everything on Premium Package PLUS
                        <br/>
                        <span class="has-tooltip" title="Lorem ipsum">UnoVPN</span> with <span class="has-tooltip" title="Lorem ipsum">PPTP</span> and <span class="has-tooltip" title="Lorem ipsum">OpenVPN</span> Protocol
                        <br/>
                        US, UK, Canada, Netherlands VPN servers
                        <br/>
                        <span class="has-tooltip" title="Lorem ipsum">Secured Servers</span> to prevent snooping and to protect your identity
                    </p>
                    <form action="https://www.unotelly.com/portal/cart.php?gid=5">
                        <input src='#' type="submit" class="try-gold-button" value="Buy Gold" data-toggle="modal" data-target=""/>
                    </form>
                </div>
            </div> -->
        </div>

        <div class="trust" id="trust">
            <div class="trust_slides_container">

                @foreach($testimonials as $testimonial)
                <div class="trust_slide">
                    <div class="content">
                        <div class="container-fluid">
                            <div class="col-md-12 col-xs-12">
                                <blockquote class="customer_testimonials">
                                    <p class='customer_testimonials'>{{ Str::limit($testimonial->quote, 170) }}</p>
                                    <footer>{{ $testimonial->name }}</footer>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

            <a class="prev"><img src="/assets/v2/images/left-button.png"></a>
            <a class="next"><img src="/assets/v2/images/right-button.png"></a>

        </div>
    </div>
</div>

<div class="footer section" id="footer">
    <div class="newsLetter">
        <h3 class="section-heading has-shadow">Try now - no credit card required.</h3>

        <div class="button-container">
            <a href="{{ URL::route('user_create') }}" class="btn btn-custom-big btn-red has-box-shadow signup-button" >Try
                for Free</a>

        </div>
    </div>
    @include('v2.frontend.partials._footer-content')

</div>

@stop

@section('scripts')
{{ HTML::script('assets/v2/lib/fullPage/jquery.fullPage.js') }}

<!-- Custom Scripts -->
{{ HTML::script('assets/v2/js/frontPage-controller.js') }}
{{ HTML::script('assets/v2/js/channels-controller.js') }}
{{ HTML::script('assets/v2/js/devices-controller.js') }}
{{ HTML::script('assets/v2/js/access-controller.js') }}
{{ HTML::script('assets/v2/js/favoriteChannels-controller.js') }}
{{ HTML::script('assets/v2/js/onDemand-controller.js') }}
{{ HTML::script('assets/v2/js/speed-controller.js') }}
{{ HTML::script('assets/v2/js/map-controller.js') }}
{{ HTML::script('assets/v2/js/pricing-controller.js') }}
{{ HTML::script('assets/v2/js/footer-controller.js') }}
{{ HTML::script('assets/v2/js/index.js') }}
@stop