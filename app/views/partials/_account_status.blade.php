<div id="loading" class="alert alert-warning">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div class="alert-heading">Checking Setup Status...</div>
</div>

<div id="all_active" class="alert alert-success">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div class="alert-heading">UnoDNS Setup and Account are active.</div>

    <br/>

    <p align="middle">
        <a class='btn btn-primary' href='http://quickstart3.unotelly.com/channels'>Watch on PC/Mac</a>
        <a class='btn btn-primary' href='#setup'>Setup Additional Devices</a>
        {{ link_to_route('dynamo_index', 'Change Netflix Country', array($uid), array('class' => 'btn btn-primary') ); }}
        <a class='btn btn-primary' href='http://help.unotelly.com/solution/categories/9628/folders/25818'
           target="_blank"><i class="icon-off icon-white"></i> Turn off UnoDNS</a>
    </p>
    <br/>

    <br/>

    <p align="middle">
        <span class='st_sharethis_hcount' displayText='ShareThis'></span>
        <span class='st_pinterest_hcount' displayText='Pinterest'></span>
        <span class='st_facebook_hcount' displayText='Facebook'></span>
        <span class='st_twitter_hcount' displayText='Tweet'></span>
        <span class='st_linkedin_hcount' displayText='LinkedIn'></span>
        <span class='st_email_hcount' displayText='Email'></span>
    </p>

</div>

<div id="setup_incomplete" class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div class="alert-heading">Your DNS setup is incomplete.</div>
    <br/>

    <p align="middle"><a class='btn btn-primary'
                         href='http://help.unotelly.com/support/solutions/articles/27287-i-m-getting-the-unodns-setup-is-incomplete-please-complete-unodns-setup-message'><i
                class="icon-info-sign icon-white"></i> Troubleshoot</a></p>

    <p align="middle">If you are still having trouble, please <a href="http://help.unotelly.com/support/tickets/new"
                                                                 target="_blank">contact support</p>
</div>

<div id="sub_suspended" class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div class="alert-heading">Your account has been suspended.</a></div>
    <br/>

    <p align="middle">Please <a href="http://help.unotelly.com/support/tickets/new"
                                                                 target="_blank">contact support</p>
</div>


<div id="known_user" class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div class="alert-heading">Please update your IP address.</div>
    <br/>



    <p align="middle">

@if(Session::get('uid'))
    <a class='btn btn-primary' href="{{ route('network_auto_update', [Authenticate::get_uid()]) }}">Update IP Address</a>
@else
    <a class='btn btn-primary' href="{{ route('session_login') }}">Update IP Address</a>
@endif


        <a class='btn btn-primary' href='http://help.unotelly.com/solution/categories/9628/folders/25818'
           target="_blank"><i class="icon-off icon-white"></i> Turn off UnoDNS</a>
    </p>

</div>

<div id="no_sub" class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div class="alert-heading">You have no subscription.</div>
    <br/>

    <p align="middle">
        <a class='btn btn-primary' href='http://www.unotelly.com/unodns/pricing' target="_blank"><i
                class="icon-shopping-cart icon-white"></i> Purchase a Subscription</a>
        <a class='btn btn-primary' href='http://www.unotelly.com/portal' target="_blank"><i
                class=" icon-circle-arrow-up icon-white"></i> Renew Account</a>
        <a class='btn btn-primary' href='http://help.unotelly.com/solution/categories/9628/folders/25818'
           target="_blank"><i class="icon-off icon-white"></i> Turn off UnoDNS</a>
    </p>
</div>

<div id="expired" class="alert alert-danger">
    <button type="button" class="close" data-dismiss="alert">&times;</button>
    <div class="alert-heading">Your account has expired. (Wrong account?

        <a href="http://quickstart3.unotelly.com/login" class="btn btn-primary">Log in</a>

     to your account)</div>
    <br/>

    <p align="middle">
        <a class='btn btn-primary' href='http://www.unotelly.com/unodns/pricing' target="_blank"><i
                class="icon-shopping-cart icon-white"></i> Purchase a Subscription</a>
        <a class='btn btn-primary' href='http://www.unotelly.com/portal' target="_blank"><i
                class=" icon-circle-arrow-up icon-white"></i> Renew Account</a>
        <a class='btn btn-primary' href='http://help.unotelly.com/solution/categories/9628/folders/25818'
           target="_blank"><i class="icon-off icon-white"></i> Turn off UnoDNS</a>
    </p>
</div>