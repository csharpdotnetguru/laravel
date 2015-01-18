@extends('layout.v2.home')

@section('title', ' | Quickstart')

@section('stylesheets')

<link rel="stylesheet" href="{{ asset('assets/v2/lib/intro.js-0.8.0/introjs.css') }}"/>

<!-- Common CSS Assets !-->
@include('v2.frontend.partials._grid-page-common-css')
<!-- End of Common CSS Assets -->
<link rel="stylesheet" href="{{ asset('assets/v2/css/jquery_gridster/jquery.gridster.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/v2/css/_uno-wizard.css') }}"/>
<link rel="stylesheet" href="{{ asset('assets/v2/css/_member-page.css') }}"/>
@stop

@section('top_bar_quickstart')
<!-- Hidden elements used for javscript as fixture -->

@include('v2.frontend.quickstart.error_modals._quickstart_setup_incomplete')
@include('v2.frontend.quickstart.error_modals._quickstart_suspended')
@include('v2.frontend.quickstart.error_modals._quickstart_unknown_ip')
@include('v2.frontend.quickstart.error_modals._quickstart_expired')
@include('v2.frontend.quickstart.error_modals._quickstart_ip_conflict')
@include('v2.frontend.quickstart.error_modals._quickstart_no_subscription')
@include('v2.frontend.quickstart.error_modals._quickstart_ok')
@include('v2.frontend.quickstart.error_modals._quickstart_first_time')
@include('v2.frontend.quickstart.error_modals._quickstart_email_confirm')

<!-- Top Status Bar -->
<div class="row">
    <div id="checking-bar" class="col-sm-12 top-status-bar">
        <p>Checking setup status...</p>
    </div>
</div>

@stop

@section('content')

<div id="full_page_container" style="margin-bottom:18px;">


    <div class="quickstart">

        <header>
            <div class="row">
                <div class="col-xs-11 page-title page-header ">

                    <h1>
                        @if(!empty($user))
                        Hi {{ $user->firstname }}!
                        @else
                        Welcome
                        @endif
                        <small>Your IP Address is {{ $user_ip }}</small>
                        <div data-step='10' data-intro='Please follow us. We really appreciate it!' class='twitter_follow' style="display:inline;"><a href="https://twitter.com/unotelly" class="twitter-follow-button" data-show-count="false">Follow @unotelly</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script></div>
                        <!-- <small> You can drag & drop to organize your favourite tiles</small> -->
                        <p class="pull-right header-small-right">
                            <a href="#" class="start-guided-tour">Start Guided Tour</a>
                        </p>

                    </h1>
                    <div data-step='11' data-intro='Please like us. Your love means a lot to us!' class="fb-like" data-href="https://www.facebook.com/unotelly" data-layout="standard" data-action="like" data-show-faces="false" data-share="true"></div>

                </div>
            </div>
        </header>
        <div class="gridster">
            <ul class="gridster">

            </ul>
        </div>

    </div>

</div>
<!-- /container -->

@include('partials._alertify')

@include('v2.frontend.partials._footer')

@stop

@section('scripts')

<script src="{{ asset('assets/v2/lib/intro.js-0.8.0/intro.js')  }}"></script>

<!--Page Specific JS Assets !-->
<script src="{{ asset('assets/v2/js/jquery_gridster/jquery.gridster.js')  }}"></script>
<script src="{{ asset('assets/v2/js/jquery_gridster/jquery.collision.js') }}"></script>
<script src="{{ asset('assets/v2/js/jquery_gridster/jquery.coords.js') }}"></script>
<script src="{{ asset('assets/v2/js/jquery_gridster/jquery.draggable.js') }}"></script>
<script src="{{ asset('assets/v2/js/jquery_gridster/jquery.gridster.extras.js') }}"></script>
<script src="{{ asset('assets/v2/js/jquery_gridster/utils.js') }}"></script>
<script src="{{ asset('assets/v2/js/classywiggle/jquery.classywiggle.min.js') }}"></script>
<script src="{{ asset('assets/v2/lib/remodal/jquery.remodal.js') }}"></script>

<script type="text/javascript">

    var dynamoLink = "{{ route('dynamo_index') }}";
    var updateIpLink = "{{ route('network_auto_update') }}";
    var dynDnsLink = "{{ route('dyndns_index') }}";
    var channelsLink = "{{ route('all_channels') }}";
    var devicesLink = "{{ route('all_devices') }}";

    var setupWizardLink = '#';
    var helpLink = 'http://help.unotelly.com/support/tickets/new';
    var knowledgeBaseLink = 'http://help.unotelly.com';
    var networksLink = "{{ route('network_index') }}";
    var myAccountLink = '{{ route("my_account_index") }}';
    var globalServersLink = '{{ route("list_dns_servers") }}';
    var channelRequestLink = 'http://help.unotelly.com/categories/4729/forums/290385';
    var AndroidAppLink = 'https://play.google.com/store/apps/details?id=com.app.unotelly';
    var resendConfirmationLink = '{{ route("user_resend_confirmation") }}';

    var dnsStatusApiLink = "{{ Config::get('app.dnsStatusApiLink') }}" ;

    var email_confirmed = '{{ $email_confirmed }}';

    var accountStatusApiLink = "{{ Config::get('app.accountStatusApiLink')}}";

    // if email is confirmed, pass it as argument
    if (email_confirmed === 'false') {
        accountStatusApiLink = accountStatusApiLink + '&email_not_confirmed=true';
    }

    $(function() {
        unoWizard.init(1, 'dns-setup-failed');	 //(default question id, target el class)

        unoWizard.init(3, 'account-suspended');

        $('.start-guided-tour').click(function() {
            var intro = introJs().start();

            // quick function to apply custom buttons
            function switchClasses() {
                var classes = ['.introjs-skipbutton', '.introjs-prevbutton', '.introjs-nextbutton'];

                classes.forEach(function(e) {
                    if (e == '.introjs-prevbutton') {
                        $(e).html($(e).html().replace('←', '<i class="glyphicon glyphicon-step-backward"></i> '));
                        $(e).addClass('btn btn-danger').removeClass('introjs-button');
                    }

                    if (e == '.introjs-nextbutton') {
                        $(e).html($(e).html().replace('→', ' <i class="glyphicon glyphicon-step-forward"></i>'));
                        $(e).addClass('btn btn-success').removeClass('introjs-button');
                    }

                    if (e == '.introjs-skipbutton') {
                        $(e).addClass('btn btn-default').removeClass('introjs-button');
                    }
                });
            }

            // calling after each change since introjs reinject buttons
            intro.onafterchange(function() {
                switchClasses();
            });

            switchClasses();
        });

        // don't show setup incomplete anymore
        $('#dont-show-setup-incomplete-anymore').click(function() {
            localStorage['dont-show-setup-incomplete-modal-quickstart'] = true;
            $('.remodal-close').click();
        });

        $('#dont-show-anymore').on('click', function() {
            localStorage['dont-show-first-time-modal-quickstart'] = true;
        });

    });

</script>

<script src="{{ asset('assets/v2/js/_member-page-grid-fixture.js') }}"></script>
<script src="{{ asset('assets/v2/js/_member-page.js') }}"></script>
<script src="{{ asset('assets/v2/js/_getAccountStatus.js') }}"></script>
<script src="{{ asset('assets/v2/js/_uno-wizard.js') }}"></script>

<!-- End of Page specific JS Assets -->

@stop
