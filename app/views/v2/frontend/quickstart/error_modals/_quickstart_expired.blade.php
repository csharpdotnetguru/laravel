<!-- Account Expired Fixture -->
<div class="fixture-account-expired hidden">
    <p class="tile-content">Account Expired. Click here to purchase subscription</p>

    <p align="center"><a class="stop-buzzing btn btn-default btn-sm" href="#"><i class="glyphicon glyphicon-flash"></i> Stop Buzzing</a></p>
</div>

<a class="fixture-account-expired-fix-link hidden" href="#account-expired"></a>

<div class="row">
    <div id="account-expired-bar" class="col-sm-12 top-status-bar">
        <p>Account Expired</p>
    </div>
</div>

<div class="remodal quickstart-modal" data-remodal-id="account-expired">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1>Oops... Your account has expired.</h1>
            <img src="{{ asset('assets/v2/images/icons/Warning-Message-128.png') }}"/>

            <p>Your account has expired. Please <a href="https://www.unotelly.com/portal/cart.php?gid=4">click here to renew.</a></p>

            <hr>
            <h3>
                Already have an active subscription?
            </h3>

            <p>Please <a href="http://help.unotelly.com/support/tickets/new">contact our customer support</a></p>
            @include('v2.frontend.quickstart.error_modals._obfusticated_emails')
        </div>
    </div>
</div>
