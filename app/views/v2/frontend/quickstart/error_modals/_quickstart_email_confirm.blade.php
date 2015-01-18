<!-- Unconfirmed Email Fixture -->
<div class="fixture-email-confirm hidden">
    <p class="tile-content">Email not confirmed! @include('v2.frontend.quickstart.error_modals._trial_days_left', ['days_left' => $trial_days_left])</p>

    <p align="center" style="margin-top:16px;">
        <a class="btn btn-success btn-sm resend-confirmation" href="{{ URL::route('user_resend_confirmation') }}"><i class="glyphicon glyphicon-repeat"></i> Send Confirmation</a>
        <a class="stop-buzzing btn btn-default btn-sm" href="#"><i class="glyphicon glyphicon-flash"></i> Stop Buzzing</a>
    </p>
</div>

<a class="fixture-email-confirm-fix-link hidden" href="#email-confirm"></a>

<div class="remodal quickstart-modal" data-remodal-id="email-confirm">
    <div class="row">
        <div class="col-sm-12 text-center">
            <h1>Oops... Email not confirmed!</h1>
            <img src="{{ asset('assets/v2/images/icons/Warning-Message-128.png') }}"/>

            <p>Please check your emails and make sure to click on the confirmation email<br /> inside the welcome email you received when signing up.</p>

            <p>
                Didn't receive the confirmation e-mail? Click here to resend e-mail confirmation:
            </p>

            <p>
                <a class="btn btn-success btn-sm resend-confirmation" href="{{ URL::route('user_resend_confirmation') }}"><i class="glyphicon glyphicon-repeat"></i> Send Confirmation</a>
            </p>
        </div>
    </div>
</div>