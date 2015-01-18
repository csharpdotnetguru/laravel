<!-- Setup Incomplete Fixture -->
<div class="fixture-incomplete hidden">
    <p class="tile-content">DNS Setup Incomplete. Please click here to fix.</p>
    <p align="center"><a class="stop-buzzing btn btn-default btn-sm" href="#"><i class="glyphicon glyphicon-flash"></i> Stop Buzzing</a></p>
</div>

<a class="fixture-incomplete-fix-link hidden" href="#dns-setup-failed"></a>

<div class="row">
    <div id="dns-failed-bar" class="col-sm-12 top-status-bar">
        <p>Setup Failed</p>
    </div>
</div>

<div class="remodal quickstart-modal dns-setup-failed" data-remodal-id="dns-setup-failed">

    <div class="row">
        <div class="col-sm-12 text-center">
            <h1>Oops... DNS Setup is not complete</h1>
            <img src="{{ asset('assets/v2/images/icons/Warning-Message-128.png') }}"/>

            <p>Your DNS setup is not complete. Please follow the solutions below.</p>
            <hr>

            <a class="btn btn-large btn-primary restart-uno-wizard" href="#">Restart Wizard</a>
            <a class="btn btn-large btn-default" href="#" id="dont-show-setup-incomplete-anymore">Don"t show again</a>

            <hr>
        </div>
    </div>

    @include('v2.frontend.quickstart.error_modals.question_containers._question_container')

</div>

<style>

    .uno-wizard {
        display: none;
    }

    .restart-uno-wizard {
        cursor: pointer;
    }

    .quickstart-modal-top {
        text-align: center;
    }

</style>