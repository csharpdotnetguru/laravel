<nav>
    <ul>
        @if($member)
        <li>{{link_to_route('user_setting','User Settings',Authenticate::get_uid())}}</li>
        <li>
            {{link_to_route('dynamo_index','Dynamo Settings',Authenticate::get_uid())}}
        </li>
        <li>
            {{link_to_route('logout','Logout')}}
        </li>
        @else
        <li>
            {{link_to_route('user_create','Sign Up')}}
        </li>
        <li>
            {{link_to_route('session_login','Login')}}
        </li>
        @endif
    </ul>
</nav>