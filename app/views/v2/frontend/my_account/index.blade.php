@extends('layout.v2.home')

@section('title', ' | My Account')

@section('content')

<div class="container main-content my-account">
    @include('v2.frontend.partials._back-button')

    @include('partials._notification')

    <header>
        <div class="row">
            <div class="col-sm-10 col-sm-offset-1 page-title page-header">
                <h1>My Account

                    <p class="pull-right header-small-right">
                        <a class="btn btn-link" href="http://help.unotelly.com/support/tickets/new">Ask a question</a>
                        <a class="btn btn-link" href="https://www.unotelly.com/portal">Billing Information</a>
                        <a class="btn btn-link" href="{{ URL::route('my_account_edit') }}">Edit my account</a>
                    </p>
                </h1>

            </div>
        </div>
    </header>

    <section>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 page-content">
                <div>
                    <h3 class="page-header">UnoDNS Package</h3>

                    <dl class="dl-horizontal">
                        <dt>Email:</dt>
                        <dd>{{ $email }}</dd>
                        <dt>Expiry Date:</dt>
                        <dd>{{ $expiry_date }}</dd>
                        <dt>Account Status:</dt>
                        <dd>{{ $sub_status }}</dd>
                    </dl>

                </div>
            </div>
        </div>
    </section>

    @if($has_vpn)
    <section>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 page-content">
                <div>
                    <h3 class="page-header">UnoVPN Package
                        <p class="pull-right header-small-right"><a href="http://help.unotelly.com/support/solutions/folders/59990">UnoVPN Setup Instruction</a></p>
                    </h3>

                    <dl class="dl-horizontal">
                        <dt>UnoVPN username:</dt>
                        <dd>{{ $email }}</dd>
                        <dt>UnoVPN Password:</dt>
                        <dd>{{ $unovpn_pw }}</dd>
                        <dt>Expiry Date:</dt>
                        <dd>{{ $unovpn_expiry }}</dd>
                    </dl>

                </div>
            </div>
        </div>
    </section>
    @endif

    <section>
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 page-content">

                <h3 class="page-header">Personal Information</h3>

                <dl class="dl-horizontal">
                    <dt>First Name:</dt>
                    <dd>{{ $user->firstname }}</dd>
                    <dt>Last Name:</dt>
                    <dd>{{ $user->lastname }}</dd>
                    <dt>E-mail:</dt>
                    <dd>{{ $user->email }}</dd>
                    <dt>Billing Address:</dt>
                    <dd>{{ $user->address1 }}</dd>
                    <dt>Country:</dt>
                    <dd>{{ $user->country }}</dd>
                    <dt>Province/State:</dt>
                    <dd>{{ $user->state }}</dd>
                    <dt>City:</dt>
                    <dd>{{ $user->city }}</dd>
                    <dt>Zip/Postal Code:</dt>
                    <dd>{{ $user->postcode }}</dd>
                </dl>

            </div>
        </div>
    </section>

</div>

@include('v2.frontend.partials._footer')

@stop