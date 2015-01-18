<footer>
    <ul>
        <li>{{link_to_route('channel_index','Channels')}}</li>
        <li>{{link_to_route('review_index','Review')}}</li>
        <li>{{link_to_route('domain_list_index','Domain List')}}</li>
        @if(AdminUserController::isAdmin())
        <li>{{link_to_route('admin_logout','Logout')}}</li>
        @else
        <li>{{link_to_route('session_logout','Logout')}}</li>
        @endif
    </ul>
</footer>