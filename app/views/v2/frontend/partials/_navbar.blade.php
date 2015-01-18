@section('navbar-home')
<div class="navbar-collapse collapse" style="height: 1px;">
    <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ URL::route('home') }}">Home</a></li>
        <li><a href="{{ URL::route('all_channels') }}">Channels</a></li>
        <li><a href="{{ URL::route('all_devices') }}">Devices</a></li>
        <li><a href="{{ URL::route('home') }}#10-pricing">Pricing</a></li>
        <!-- <li><a href="{{ URL::route('faqs') }}">FAQs</a></li> -->
        <li><a href="{{ URL::route('press_reviews') }}">Press Reviews</a></li>
        @if(Authenticate::member())
        <li><a href="{{ URL::route('quickstart_index') }}">Quickstart</a></li>
        <li class="space-before-buttons">
            <a href="{{ URL::route('session_logout') }}">Logout</a>
        </li>
        @else
        <li class="space-before-buttons">
            <a href="{{ URL::route('session_login') }}">Sign In</a>
        </li>
        @endif        </li>
        @if(!Authenticate::member())
        <li>
            <a class="header-button has-box-shadow signup-button" id="header-signup" href="{{ URL::route('user_create') }}" >Try for Free</a>
        </li>
        @endif
    </ul>
</div>
@stop

@section('navbar-logged-in')
<div class="navbar-collapse collapse" style="height: 1px;">
    <ul class="nav navbar-nav navbar-right">
        <li><a href="{{ URL::route('quickstart_index') }}">Quickstart</a></li>
        <li><a href="{{ route('my_account_index') }}">My Account</a></li>
        <li><a href="http://help.unotelly.com">Help</a></li>
        <li class="space-before-buttons"><a href="{{ URL::route('session_logout') }}">Logout</a></li>
        <li><a href="{{ URL::route('home') }}">Home</a></li>
    </ul>
</div>
@stop

<div class="navbar navbar-default @if(isset($is_home)) navbar-fixed-top @endif" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{ URL::route('home') }}"><img id="header-logo-img" src="{{ URL::to('assets/v2/images/logo.png') }}"/></a>
        </div>

        @if(Authenticate::is_logged_in())
            @if(isset($is_home))
                @yield('navbar-home')
            @else
                @yield('navbar-logged-in')
            @endif
        @else
            @yield('navbar-home')
        @endif

    </div>
</div>