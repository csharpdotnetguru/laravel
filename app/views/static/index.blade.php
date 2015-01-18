@extends('layout.test')

@section('status')
<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.css"/>

@if(!is_null($origin))
<meta http-equiv='refresh' content='2;url={{$origin}}'>
@endif

@include('partials._account_status')

@stop

@section('content')

<div class="row">
    <div class="col-xs-8">

@if(Authenticate::is_logged_in())
        <div>
           <h3 class='page-header'>My Account </h3>

           <table class="table">
                <tr>
                    <td>Email: </td>
                    <td>{{ $email }}</td>
                </tr>                <tr>
                    <td>Expiry Date: </td>
                    <td>{{ $expiry_date }} </td>
                </tr>
                <tr>
                    <td>Account Status: </td>
                    <td>{{ $sub_status }}</td>
                </tr>
            </table>

        </div>

        @if($has_vpn === TRUE)
                <div>
                   <h3 class='page-header'>UnoVPN <small><a href='http://help.unotelly.com/support/solutions/folders/59990'>Setup Instruction</a></small></h3>

                   <table class="table table">
                        <tr>
                            <td>UnoVPN Login: </td>
                            <td>{{ $email }}</td>
                        </tr>                <tr>
                            <td>UnoVPN Expiry Date: </td>
                            <td>{{ $unovpn_expiry }} </td>
                        </tr>
                        <tr>
                            <td>UnoVPN Password: </td>
                            <td>{{ $unovpn_pw }}</td>
                        </tr>
                    </table>


                </div>
        @endif

@endif

        <h3 class='page-header'>How do I sign up for Netflix, Vudu, Hulu Plus and other streaming services?</h3>

        <ul><a href="http://help.unotelly.com/solution/categories/15998/folders/25821" target="_BLANK">
                <img src="https://www.unotelly.com/unodns/images/channels/netflix.png"/> Netflix </a>

            --- Now you can change Netflix regions as well: <a href="http://www.unotelly.com/quickstart2/dynamo.php"
                                                               target="_BLANK">
                How to change Netflix regions</a>

        </ul>

        <ul><a href="http://help.unotelly.com/solution/categories/15998/folders/29922" target="_BLANK"><img
                    src="https://www.unotelly.com/unodns/images/channels/bbciplayer.png"/> BBC iPlayer</a></ul>
        <ul><a href="http://help.unotelly.com/solution/articles/17021-how-to-sign-up-hulu-plus-outside-usa"
               target="_BLANK"><img src="https://www.unotelly.com/unodns/images/channels/hulu.png"/> Hulu+</a></ul>
        <ul>
            <a href="http://www.unotelly.com/blog/2013/01/how-to-avoid-nhl-blackouts-and-watch-your-home-team-toronto-maple-leafs-if-you-are-a-canadian/"
               target="_BLANK"><img src="https://www.unotelly.com/unodns/images/channels/nhl.png"/> How to remove all NHL
                Blackouts!</a></ul>
        <ul>
            <a href="http://help.unotelly.com/solution/categories/15998/folders/93992/articles/50430-how-to-watch-ufc-live-replay"
               target="_BLANK"><img src="https://www.unotelly.com/unodns/images/channels/ufc.png"/> How to watch UFC Live
                for free!</a></ul>
        <ul>
            <a href="http://help.unotelly.com/solution/articles/24706-how-to-get-nfl-game-pass-and-watch-live-games-in-usa-canada-uk-and-ireland-without-blackout"
               target="_BLANK"><img src="https://www.unotelly.com/unodns/images/channels/nfl.png"/> How to get NFL game
                pass for live streaming without blackout in USA, Canada, UK, and Ireland</a></ul>
        <ul><a href="http://help.unotelly.com/solution/articles/31901-how-to-watch-nba-league-pass-without-blackout"
               target="_BLANK"><img src="https://www.unotelly.com/unodns/images/channels/nbatv.png"/> How to sign up NBA
                League Pass without blackout</a></ul>
        <ul><a href="http://help.unotelly.com/solution/categories/15998/folders/35754" target="_BLANK"><img
                    src="https://www.unotelly.com/unodns/images/channels/amazon.png"/> How to sign up free trial Amazon
                Prime outside USA</a></ul>
        <ul><a href="http://help.unotelly.com/solution/articles/17022-how-to-sign-up-spotify-outside-usa-"
               target="_BLANK"><img src="https://www.unotelly.com/unodns/images/channels/spotify.png"/> Spotify</a></ul>
        <ul>
            <a href="http://help.unotelly.com/solution/articles/25899-how-to-get-around-mlb-tv-blackout-and-watch-your-home-team-and-blue-jays-if-you-are-canadian-"
               target="_BLANK"><img src="https://www.unotelly.com/unodns/images/channels/mlb.png"/> How to get around
                MLB.TV blackout and stream local team (and Blue Jays for Canadian)</a></ul>

    </div>

    <div class="col-xs-4">
        <script>!function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (!d.getElementById(id)) {
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//platform.twitter.com/widgets.js";
                    fjs.parentNode.insertBefore(js, fjs);
                }
            }(document, "script", "twitter-wjs");</script>
        <div class="fb-like-box" data-href="http://www.facebook.com/unotelly" data-width="292" data-show-faces="true"
             data-stream="false" data-header="true"></div>
    </div>
    <div class="clear"></div>
</div>


<a name="setup"></a>
<h1 class='page-header'>UnoDNS Setup
    <small></small>
</h1>

<table class="table table-striped">

    <thead>
    <tr>
        <th>Computer Devices</th>
        <th>TV Devices</th>
        <th>Mobile Devices</th>
        <th>Router Devices</th>
    <tr>
    </thead>

    <tbody>
    <tr>
        <td>
            <a href="http://help.unotelly.com/solution/categories/18721/folders/29878/articles/9448-manual-setup-unodns-on-your-windows-7-vista"
               target="_BLANK"> Windows 7/Vista</a></td>
        <td><a href="http://help.unotelly.com/solution/categories/18724/folders/29881" target="_BLANK"> Xbox 360</a>
        </td>
        <td><a href="http://help.unotelly.com/solution/categories/18725/folders/29892" target="_BLANK">
                iPad/iPone/iPod</a></td>
        <td>
            <a href="http://help.unotelly.com/solution/categories/18726/folders/29894/articles/9490-general-router-instruction-roku-click-here-"
               target="_BLANK">My router is not listed. Help!</a></td>
    </tr>

    <tr>
        <td>
            <a href="http://help.unotelly.com/solution/categories/18721/folders/29878/articles/9449-manual-setup-unodns-on-your-windows-xp"
               target="_BLANK"> Windows XP</a></td>
        <td><a href="http://help.unotelly.com/solution/categories/18724/folders/29882" target="_BLANK"> PS3</a></td>
        <td><a href="http://help.unotelly.com/solution/categories/18725/folders/29893" target="_BLANK"> Android</a></td>
        <td><a href="http://help.unotelly.com/solution/articles/9491-cisco-linksys" target="_BLANK">Linksys/Cisco</a>
        </td>
    </tr>

    <tr>
        <td><a href="http://help.unotelly.com/solution/categories/18721/folders/29879/articles/9450-mac-osx"
               target="_BLANK"> Mac OSX</a></td>
        <td><a href="http://help.unotelly.com/solution/categories/18724/folders/29883" target="_BLANK"> Wii</a></td>
        <td><a href="http://help.unotelly.com/solution/categories/18725/folders/29892" target="_BLANK"> Sonos</a></td>
        <td><a href="http://help.unotelly.com/solution/categories/18726/folders/29894/articles/9571-buffalo"
               target="_BLANK"> Buffalo</a></td>
    </tr>

    <tr>
        <td><a href="http://help.unotelly.com/solution/categories/18721/folders/29880/articles/9451-linux-ubuntu"
               target="_BLANK"> Linux</a></td>
        <td><a href="http://help.unotelly.com/solution/categories/18724/folders/29895" target="_BLANK"> Apple TV</a>
        </td>
        <td><a href="http://help.unotelly.com/solution/articles/54094-how-to-change-dns-on-amazon-kindle-fire-hd-"
               target="_BLANK">Amazon Kindle Fire HD</a></td>
        <td><a href="http://help.unotelly.com/solution/categories/18726/folders/29894/articles/9492-d-link"
               target="_BLANK"> D'Llink</a></td>
    </tr>

    <tr>
        <td></td>
        <td><a href="http://help.unotelly.com/solution/categories/18724/folders/29890" target="_BLANK"> Boxee Box</a>
        </td>
        <td></td>
        <td><a href="http://help.unotelly.com/solution/articles/37785-apple-airport-extreme" target="_BLANK"> Apple
                Airport</a></td>
    </tr>

    <tr>
        <td></td>
        <td><a href="http://help.unotelly.com/solution/categories/18724/folders/30954" target="_BLANK"> Google TV</a>
        </td>
        <td></td>
        <td><a href="http://help.unotelly.com/solution/categories/18726/folders/29894/articles/17024-netgear"
               target="_BLANK"> Netgear</a></td>
    </tr>

    <tr>
        <td></td>
        <td><a href="http://help.unotelly.com/solution/categories/18724/folders/29889" target="_BLANK"> LG Smart TV</a>
        </td>
        <td></td>
        <td>
            <a href="http://help.unotelly.com/solution/categories/18726/folders/29894/articles/17040-bell-cellpipe-alu-7130-n-modem"
               target="_BLANK">Bell Cellpipe ALU 7130-N Modem</a></td>
    </tr>

    <tr>
        <td></td>
        <td><a href="http://help.unotelly.com/solution/categories/18724/folders/29891" target="_BLANK"> Roku</a></td>
        <td></td>
        <td>
            <a href="http://help.unotelly.com/solution/categories/18726/folders/29894/articles/17038-bell-speedstream-6520-modem"
               target="_BLANK"> Bell Aliant SpeedStream 6520 </a></td>
    </tr>

    <tr>
        <td></td>
        <td><a href="http://help.unotelly.com/solution/categories/18724/folders/29884" target="_BLANK"> WD TV LIVE</a>
        </td>
        <td></td>
        <td><a href="http://help.unotelly.com/solution/categories/18726/folders/29894/articles/17043-bell-2wire-modem"
               target="_BLANK"> Bell 2Wire</a></td>
    </tr>

    <tr>
        <td></td>
        <td><a href="http://help.unotelly.com/solution/categories/18724/folders/29888" target="_BLANK"> Dynex Blu-Ray
                Player</a></td>
        <td></td>
        <td>
            <a href="http://help.unotelly.com/solution/categories/18726/folders/29894/articles/17044-simens-gigaset-se567"
               target="_BLANK"> Simens Gigaset SE567</a></td>
    </tr>

    <tr>
        <td></td>
        <td><a href="http://help.unotelly.com/solution/categories/18724/folders/29886" target="_BLANK"> Panasonic TV and
                Blu-Ray Player</a></td>
        <td></td>
        <td>
            <a href="http://help.unotelly.com/solution/categories/18726/folders/29894/articles/17045-actiontec-r1000h-router"
               target="_BLANK"> Actiontec R100H</a></td>
    </tr>

    <tr>
        <td></td>
        <td><a href="http://help.unotelly.com/solution/categories/18724/folders/29887" target="_BLANK"> Samsung TV and
                Blu-Ray Player </a></td>
        <td></td>
        <td><a href="http://help.unotelly.com/solution/articles/17048-tp-link-router" target="_BLANK">TP-Link</a></td>
    </tr>

    <tr>
        <td></td>
        <td><a href="http://help.unotelly.com/solution/categories/18724/folders/29885" target="_BLANK"> Sony TV and
                Blu-Ray Player </a></td>
        <td></td>
        <td></td>
    </tr>

    <tr>
        <td></td>
        <td><a href="http://help.unotelly.com/solution/categories/18724/folders/29937" target="_BLANK"> Toshiba TV and
                Blu-Ray Player </a></td>
        <td></td>
        <td></td>
    </tr>
    </tbody>
</table>

{{  HTML::script('assets/scripts/get_account_status.js')  }}


@stop