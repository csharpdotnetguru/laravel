<!-- Update IP Fixture -->
<div class="fixture-update-ip hidden">
    <p class="tile-content">Please click here to Update IP.</p>
    <p align="center"><a class="stop-buzzing btn btn-default btn-sm" href="#"><i class="glyphicon glyphicon-flash"></i> Stop Buzzing</a></p>
</div>

<a class="fixture-update-ip-fix-link hidden" href="#update-ip"></a>

<div class="row">
    <div id="unknown-user-bar" class="col-sm-12 top-status-bar">
        <p>Please Update IP</p>
    </div>
</div>

<div class="remodal quickstart-modal" data-remodal-id="update-ip">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1>Oops... You have a new IP.</h1>
            <img src="{{ asset('assets/v2/images/icons/Warning-Message-128.png') }}"/>

            <p>Your new IP Address is {{ $user_ip }}.</p>

            <p>Please <a href="{{ route('network_auto_update') }}">click here update IP.</a></p>

            <hr>

            <h3>
                Seeing this message too often?
            </h3>

            <p>Please <a href="http://help.unotelly.com/support/solutions/27360">click here to setup automatic IP Update</a></p>
        </div>
    </div>
</div>
