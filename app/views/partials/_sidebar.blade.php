<div class=" ">

    <a href="#">
        <div class="uno_phone_menu_click uno_phone_menu_triangle_light uno-mobile">
        </div>
    </a>

    <div class="_sidebar-content">
        <h3>UnoDNS</h3>
        <ul class="nav nav-pills nav-stacked">
            <li class=@if(isset($home)){{$home}}@endif>
                <a href="{{URL::route('home')}}">
                    <i class="icon-home"></i>
                    Quickstart Home</a>
            </li>

            

            <li class=@if(isset($authorized_network)){{$authorized_network}}@endif>
                <a href="{{URL::route('network_index')}}">
                    <i class="icon-ok"></i>
                    Authorized Networks</a>
            </li>

            <li class=@if(isset($dyn)){{$dyn}}@endif> <!-- Conditional active class -->
                <a href="{{URL::route('dyndns_index')}}">
                    <i class="icon-upload"></i>
                    DynDNS Update</a>
            </li>

            <li>
                <a id='auto_update_ip' href="{{URL::route('network_auto_update')}}">
                    <i class="icon-hand-up"></i>
                    Update IP Address</a>
            </li>


            @if(Authenticate::is_logged_in())
            <li>

                <a href="{{URL::route('session_logout')}}">
                    <i class="icon-circle-arrow-up"></i>
                    Sign Out</a>
            </li>
            @else
            <li>
                <a href="{{URL::route('session_login')}}">
                    <i class="icon-circle-arrow-up"></i>
                    Sign In</a>
                
            </li>
            @endif
            

            <li>
                <a href="http://help.unotelly.com/solution/categories/9628/folders/25818" target="_BLANK">
                    <i class="icon-off"></i>
                    Turn off UnoDNS</a>
            </li>

            <li>
                <a href="http://www.unotelly.com/unodns/global" target="_BLANK"><i class="icon-globe"></i> Global
                    Servers</a>
            </li>


        </ul>


        <h3>Watch Now</h3>
        <ul class="nav nav-pills nav-stacked">
            <!--
                <li >
                    <a href="free.php">
                    Free Channels</a>
                </li>
            -->
            <li>
                <a href="http://www.unotelly.com/unodns/channels.php">
                    Premium & Gold Channels</a>
            </li>
            <li>
                <a href="http://help.unotelly.com/support/tickets/new" target="_BLANK">
                    Request a Channel</a>
            </li>
        </ul>


        <h3>Dynamo</h3>
        <ul class="nav nav-pills nav-stacked">

            <li><a href="http://help.unotelly.com/solution/categories/9628/folders/115866">What is Dynamo?</a></li>
            <li class=@if(isset($change_setting)){{$change_setting}}@endif >
                {{link_to_route('dynamo_index','Change Settings')}}
            </li>
            
        </ul>

        <!-- User profile section -->
        <h3>User Profile</h3>
        <ul class="nav nav-pills nav-stacked">
            <li class='' >
                {{link_to_route('user_edit','Update Profile')}}
            </li>
        </ul>

    </div>
</div>