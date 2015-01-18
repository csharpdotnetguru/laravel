<head>
    <title>@if(isset($title)) {{ $title }} @endif</title>

    <meta content="minimum-scale=1.0, width=device-width, maximum-scale=1.0, user-scalable=no, name="viewport" />
    <script>
        var errorIndex='{{URL::route('error_index')}}';
        var sessionLogout='{{URL::route('session_logout')}}';
        var userRedirectIndex='{{URL::route('user_redirect_index')}}';
        var sessionAuthenticate='{{URL::route('session_authenticate')}}';
        var sessionLogin='{{URL::route('session_login')}}';
        var dynamoIndex='{{URL::route('dynamo_index',['uid'=>Authenticate::get_uid()])}}';
        var dynamoUpdate='{{URL::route('dynamo_update',['uid'=>Authenticate::get_uid()])}}';
        var updateAjax='{{URL::route('updateAjax',['uid'=>Authenticate::get_uid()])}}';
        var userIndex='{{URL::route('user_index',['uid'=>Authenticate::get_uid()])}}';

        @if(isset($network_id))
            var networkIndex='{{URL::route('network_index',['uid'=>Authenticate::get_uid()])}}';
        var networkCreate='{{URL::route('network_create',['uid'=>Authenticate::get_uid()])}}';
        var networkShow='{{URL::route('network_show'),['uid'=>Authenticate::get_uid()]}}';
        var networkEdit='{{URL::route('network_edit'),['uid'=>Authenticate::get_uid()]}}';
        var networkAutoUpdate='{{URL::route('network_auto_update',['uid'=>Authenticate::get_uid()])}}';
        var networkUpdate='{{URL::route('network_update')}}';
        var networkToggle='{{URL::route('network_toggle')}}';
        var networkStore='{{URL::route('network_store')}}';
        var networkDestroy='{{URL::route('network_destroy')}}';
        @endif

    </script>
    {{  HTML::style('bootstrap/css/bootstrap.css')  }}
    {{  HTML::style('assets/css/unodns.css?v=1.1')        }}
    {{  HTML::style('assets/css/style.css')         }}

    {{  HTML::style('assets/alertify/themes/alertify.core.css')     }}
    {{  HTML::style('assets/alertify/themes/alertify.default.css')  }}
    {{  HTML::style('assets/css/sass/css/uno_style.css')            }}

    {{  HTML::script('https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js')  }}
    {{  HTML::script('assets/scripts/script.js')  }}
    {{  HTML::script('bootstrap/js/bootstrap-alert.js')  }}
    {{  HTML::script('bootstrap/js/bootstrap-collapse.js')  }}
    {{  HTML::script('assets/equalize/js/equalize.js')  }}
    {{  HTML::script('assets/alertify/lib/alertify.min.js')  }}
    {{  HTML::script('assets/scripts/uno_script.js')  }}



    <?php //for testing and development
    /*
        <script type="text/javascript">
            $.getJSON('http://setupcheckapi.unotelly.com/index.php?callback=?&type=json', function (data) {
                var dns_status;
                dns_status = data.dns_status;
                $.getJSON('inc/account_status_api.php?callback=?&type=json', function (data) {
                    var account_status;
                    var expiry_status;
                    account_status = data.account_status;
                    expiry_status = data.expiry_status;
                    if (dns_status == 'true' && account_status == 'active' && expiry_status == 'active') {
                        $('#loading').hide();
                        $('#all_active').fadeIn()
                    }
                    else if (dns_status != 'true') {
                        $('#loading').hide();
                        $('#dns_false').fadeIn()
                    }
                    else if (dns_status == 'true' && account_status == 'active' && expiry_status != 'active') {
                        $('#loading').hide();
                        $('#account_expired').fadeIn()
                    }
                    else {
                        $('#loading').hide();
                        $('#unknown_user').fadeIn()
                    }
                });

            });


        </script>
    */
    ?>
    <script type="text/javascript">var switchTo5x = false;</script>
    <script type="text/javascript" src="https://ws.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript">stLight.options({publisher: "ur-48e85e24-10e7-398e-ee24-40501f5698b"}); </script>


</head>