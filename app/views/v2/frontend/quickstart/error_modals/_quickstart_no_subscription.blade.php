<!-- No Subscrption -->
<div class="fixture-no-subscription hidden">
    <p class="tile-content">No Subscrption. Click here to fix.</p>
    <p align="center"><a class="stop-buzzing btn btn-default btn-sm" href="#"><i class="glyphicon glyphicon-flash"></i> Stop Buzzing</a></p>
</div>

<div class="row">
    <div id="no-subscription-bar" class="col-sm-12 top-status-bar">
        <p>No Subscription</p>
    </div>
</div>

<a class="fixture-no-subscription-fix-link hidden" href="#no-subscription"></a>

<div class="remodal quickstart-modal" data-remodal-id="no-subscription">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1>Oops... No Subscription Found.</h1>
            <img src="{{ asset('assets/v2/images/icons/Warning-Message-128.png') }}"/>

            <p>No Subscription Found. Please <a href="#">click here to buy a subscription.</a></p>
            @include('v2.frontend.quickstart.error_modals._obfusticated_emails')
        </div>
    </div>
</div>