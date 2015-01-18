<?php

$domain = Config::get('app.domain');

App::bind('DynamoRepositoryInterface', 'EloquentDynamoRepository');
App::bind('UserRepositoryInterface', 'EloquentUserRepository');
App::bind('FreeRepositoryInterface', 'EloquentFreeRepository');
App::bind('NetworkRepositoryInterface', 'EloquentNetworkRepository');
App::bind('SubRepositoryInterface', 'EloquentSubRepository');
App::bind('DynDnsRepositoryInterface', 'EloquentDynDnsRepository');
App::bind('DeviceRepositoryInterface', 'EloquentDeviceRepository');
App::bind('DnsServerRepositoryInterface', 'EloquentDnsServerRepository');
App::bind('PackageRepositoryInterface', 'EloquentPackageRepository');
App::bind('SessionRepositoryInterface', 'EloquentSessionRepository');
App::bind('MiscRepositoryInterface', 'EloquentMiscRepository');
App::bind('SetupWizardRepositoryInterface', 'EloquentSetupWizardRepository');
App::bind('RateLimitRepositoryInterface', 'RateLimitRepository');
App::bind('BillingRepositoryInterface', 'EloquentBillingRepository');

/*********************************
 *
 * Routes available
 *
 * /
 * route name:root
 * Controller:SessionController
 * Method:login
 *
 *
 *
 *********************************/


Route::pattern('uid', '[0-9]+');

route::group(['domain' => 'setupcheckapi.' . $domain, 'before' => ''], function () {
    route::get('/', function() {
        $clientIp = $_SERVER['REMOTE_ADDR'];
        $proxyIp = '37.59.89.156';
        $proxyIp2 = '109.123.66.13';
        $proxyIp3 = '98.142.141.244';

        $time = time();
        if($clientIp == $proxyIp OR $clientIp == $proxyIp2 OR $clientIp == $proxyIp3 ){

            $status = "true";
        }   
        else {
            $status = "false";
        }
        header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
        header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past



        if(empty($_GET['type'])){
        echo $status;
        }
        else {
        $jsonData = json_encode(array('dns_status' => $status));
        echo $_GET['callback'] . '(' . $jsonData . ');';
        }
    });
});

// Route::group(['domain' => 'worldcup.' . $domain, 'before' => 'force_ssl'], function () {
//     // World Cup 2014

//     Route::get('/', ['as' => 'wc2014', 'uses' => 'FrontEnd\V2\PromoController@wc2014']);
//     Route::get('/signup', ['as' => 'wc2014_signup', 'uses' => 'FrontEnd\V2\UserController@get_signup_view']);
//     Route::get('/content', ['as' => 'wc2014_content', function() {
//         return View::make('v2.frontend.promo.wc2014_content');
//     }]);

//     // End of World Cup 2014

// });


Route::group(['domain' => 'quickstart3.' . $domain, 'before' => ''], function () {
    Route::get('', function() {
        return Redirect::route('quickstart_index');
    });
});


$main_routes = function () {

    Route::group(['before' => 'force_ssl'], function () {

        Route::group(['before' => 'has_cookies|is_guest'], function () {
            Route::post('login', array('before' => 'csrf', 'as' => 'session_authenticate', 'uses' => 'SessionController@authenticate'));
        });

        //login route filter
        route::group(['before' => ['']], function () {
            Route::get('/checkout/login/', ['as' => 'checkout_login', 'uses' => 'SessionController@checkout_login']);
            Route::post('/checkout/login/', ['before' => 'csrf', 'as' => 'checkout_login_auth', 'uses' => 'SessionController@checkout_login_auth']);

        });

        // UnoTelly V2 Routes
        //Home Page

        Route::get('', function() {
            if(Authenticate::is_logged_in()) {
                return Redirect::route('quickstart_index');
            }
            return Redirect::route('home');
        });

        
        Route::get('/user/confirm/{confirmation_key}', ['as' => 'user_confirmation', 'uses' => 'FrontEnd\V2\UserController@confirm']);


        Route::get('cc_recaptcha', ['uses' => 'FrontEnd\V2\RatelimitController@get_form_cc_update_recaptcha']);
        Route::post('solve_cc_recaptcha', ['as' => 'solve_cc_recaptcha', 'uses' => 'FrontEnd\V2\RatelimitController@solve_cc_update_recaptcha']);


        Route::get('home', ['as' => 'home', 'uses' => 'FrontEnd\V2\HomeController@index']);
        Route::get('quickstart', ['as' => 'quickstart_index', 'uses' => 'FrontEnd\V2\QuickstartController@index']);
        Route::get('global-servers', ['as' => 'list_dns_servers', 'uses' => 'FrontEnd\V2\ListDnsServerController@index']);
        Route::get('redirect-update', ['as' => 'redirect_update', 'uses' => 'FrontEnd\V2\QuickstartController@redirect_update']);
        Route::get('press-reviews', ['as' => 'press_reviews', 'uses' => 'FrontEnd\V2\HomeController@pressReviews']);
        Route::get('faqs', ['as' => 'faqs', 'uses' => 'FrontEnd\V2\HomeController@faqs']);

        Route::get('/signup', ['as' => 'user_create', 'uses' => 'FrontEnd\V2\UserController@get_signup_view']);

        // single routes
        Route::get('devices', ['as' => 'all_devices', 'uses' => 'FrontEnd\V2\DeviceController@index']);
        Route::get('devices/modal', ['as' => 'get_device_modal', 'uses' => 'FrontEnd\V2\DeviceController@get_modal']);

        Route::get('channels', ['as' => 'all_channels', 'uses' => 'FrontEnd\V2\ChannelController@index']);
        Route::get('channels/modal', ['as' => 'get_channel_modal', 'uses' => 'FrontEnd\V2\ChannelController@get_modal']);
        Route::post('channels/mark-favourite/{channel_code}', ['as' => 'channels_mark_favourite', 'uses' => 'FrontEnd\V2\ChannelController@mark_favourite']);



        Route::group(['before' => 'has_cookies|is_guest'], function () {
            Route::get('login', array('as' => 'session_login', 'uses' => 'FrontEnd\V2\SessionController@signIn'));
        });

        Route::get('logout', array('as' => 'session_logout', 'uses' => "SessionController@logout")); //doesn't need "guest" filter; nick 7/12/2013


        Route::group(['before' => ''], function () {
            Route::post('signup', array('as' => 'user_store', 'before' => 'csrf', 'uses' => 'FrontEnd\V2\UserController@createAccount'));

        });


        //Email Optout
        Route::get('email_optout', ['uses' => 'FrontEnd\V2\EmailOptoutController@get_email_optout_view']);
        Route::post('email_optout', ['as' => 'email_optout', 'uses' => 'FrontEnd\V2\EmailOptoutController@post_email_optout']);



        //Member Only Routes
        Route::group(['before' => 'has_cookies|is_member'], function () {
            Route::get('dynamo', ['as' => 'dynamo_index', 'uses' => 'FrontEnd\V2\DynamoController@index']);
            Route::get('my-account', ['as' => 'my_account_index', 'uses' => 'FrontEnd\V2\MyAccountController@index']);
            Route::get('my-account/edit', ['as' => 'my_account_edit', 'uses' => 'FrontEnd\V2\MyAccountController@edit']);
            Route::put('my-account/edit', ['as' => 'my_account_update', 'uses' => 'FrontEnd\V2\MyAccountController@update']);

            /* DynDNS */

            Route::get('dyndns', ['before' => '',  'as' => 'dyndns_index',  'uses' => 'FrontEnd\V2\DynDnsController@index']);
            Route::get('dyndns/create', ['before' => '',  'as' => 'dyndns_create', 'uses' => 'FrontEnd\V2\DynDnsController@create']);
            Route::get('dyndns/{dyndns_id}/edit', ['before' => 'correct_dyndns_owner', 'as' => 'dyndns_edit', 'uses' => 'FrontEnd\V2\DynDnsController@edit'])->where('dyndns_id','[0-9]+');

            Route::post('dyndns', ['before' => 'csrf', 'as' => 'dyndns_store', 'uses' => 'DynDnsController@store']);
            Route::put('dyndns/{dyndns_id}', ['before' => 'csrf|correct_dyndns_owner', 'as' => 'dyndns_update', 'uses' => 'FrontEnd\V2\DynDnsController@update'])->where('dyndns_id', '[0-9]+');
            Route::delete('dyndns/{dyndns_id}', ['before' => 'csrf|correct_dyndns_owner', 'as' => 'dyndns_destroy', 'uses' => 'FrontEnd\V2\DynDnsController@destroy'])->where('dyndns_id', '[0-9]+');

            /* End of DynDNS */

            Route::get('networks/', ['as' => 'network_index', 'uses' => 'FrontEnd\V2\NetworkController@index']);
            Route::get('user/network/create', ['as' => 'network_create', 'uses' => 'FrontEnd\V2\NetworkController@create']);
            Route::get('user/network/{network_id}', ['before' => 'correct_network', 'as' => 'network_show', 'uses' => 'FrontEnd\V2\NetworkController@show'])->where("network_id", "[0-9]+");
            Route::get('user/network/{network_id}/edit', ['before' => 'correct_network', 'as' => 'network_edit', 'uses' => 'FrontEnd\V2\NetworkController@edit']);
            Route::delete('/user/network/{network_id}', ['before' => 'csrf|correct_network', 'as' => 'network_destroy', 'uses' => 'FrontEnd\V2\NetworkController@destroy']);

            // email confirmation
            Route::get('/user/resend-confirmation', ['as' => 'user_resend_confirmation', 'uses' => 'FrontEnd\V2\UserController@resend_confirmation']);

            Route::get('/user/network/auto_update', ['as' => 'network_auto_update', 'uses' => 'NetworkController@auto_update']);
            Route::put('/user/network/update/{network_id}', ['before' => 'csrf|correct_network', 'as' => 'network_update', 'uses' => 'NetworkController@update']);
            Route::put('/user/network/{network_id}', ['before' => 'csrf|correct_network', 'as' => 'network_toggle', 'uses' => 'NetworkController@toggle']);
            Route::post('/user/network', ['before' => 'csrf', 'as' => 'network_store', 'uses' => 'NetworkController@store']);


        });
        //End of Member Only Routes


        // End of UnoTelly V2 Routes

        // Route::get('', ['before' => 'has_cookies', 'as' => 'home', 'uses' => 'StaticPageController@index']);
        //old quickstart



        //Route::get('channels', ['uses' => 'ChannelController@index']);
        Route::get('pricing', ['uses' => 'PricingController@index']);
        Route::get('reviews', ['uses' => 'StaticPageController@reviews_index']);

        Route::get('oops', ['as' => 'error_index', 'uses' => 'ErrorController@index']);

        Route::get('/user', ['as' => 'user_redirect_index', 'uses' => 'UserController@redirect_index']);
        Route::get('/user/check-email', ['as' => 'user_check_email', 'uses' => 'FrontEnd\V2\UserController@checkIfEmailIsDuplicated']);
        // Route::post('/signup', array('as' => 'user_store', 'before' => 'csrf', 'uses' => 'UserController@store'));


        //Create Full User
        Route::get('/user/create_full_user/', ['as' => 'create_full_user', 'uses' => 'UserController@create_full_user']);
        Route::post('/user/store_full_user/', ['as' => 'store_full_user', 'uses' => 'UserController@store_full_user']);




        Route::group(['before' => 'has_cookies|is_member'], function () {

            //to the original quickstart
            //    Route::get('/',function(){
            //        header("location:http://www.unotelly.com/quickstart2/");
            //        exit();
            //    });


            /* DynDNS */
            // NOTE: rewritten for new_web
//            Route::get('/dyndns', ['before' => '',  'as' => 'dyndns_index',  'uses' => 'DynDnsController@index']);
//            Route::get('/dyndns/create', ['before' => '',  'as' => 'dyndns_create', 'uses' => 'DynDnsController@create']);
//            Route::get('/dyndns/{dyndns_id}/edit', ['before' => 'correct_dyndns_owner', 'as' => 'dyndns_edit', 'uses' => 'DynDnsController@edit'])->where('dyndns_id','[0-9]+');
//
//            Route::post('dyndns', ['before' => 'csrf', 'as' => 'dyndns_store', 'uses' => 'DynDnsController@store']);
//            Route::put('/dyndns/{dyndns_id}', ['before' => 'csrf|correct_dyndns_owner', 'as' => 'dyndns_update', 'uses' => 'DynDnsController@update'])->where('dyndns_id', '[0-9]+');
//            Route::delete('/dyndns/{dyndns_id}', ['before' => 'csrf|correct_dyndns_owner', 'as' => 'dyndns_destroy', 'uses' => 'DynDnsController@destroy'])->where('dyndns_id', '[0-9]+');

            /* End of DynDNS */


            //Initial Set up for registration
            route::get("setup/dynamo/{uid}", function() {
                return Redirect::route('all_devices');
            });
            route::get("setup/operating-system", function() {
                return Redirect::route('all_devices');
            });


            //Frontend Dynamo


            // Route::get('/user/dynamo', array('as' => 'dynamo_index', 'uses' => 'DynamoController@edit'));
            Route::put('/user/{uid}/dynamo', ['before' => 'correct_user|csrf', 'as' => 'dynamo_update', 'uses' => 'DynamoController@update']);
            Route::post('dynamo/{uid}/updateAjax', array('before' => 'correct_user', 'uses' => 'DynamoController@updateAjax', 'as' => 'updateAjax'));

            //Frontend User
            /* - Removed UID from URL, no use of correct_user filter */
            Route::get('/user', ['as' => 'user_index', 'uses' => 'UserController@index']);
            Route::get('/user/edit', ['as' => 'user_edit', 'uses' => 'UserController@edit']);
            Route::put('/user/edit', ['as' => 'user_profile_update', 'uses' => 'UserController@update']);
            Route::get('/user/{uid}/settings', array('before' => 'correct_user', 'as' => 'user_setting', 'uses' => 'UserController@show'));
            Route::put('/user/{uid}/settings', array('before' => 'correct_user|csrf', 'as' => 'user_update', 'uses' => 'UserController@update'));


        });

    });
};

/* Internal API */
route::group(array('prefix' => 'api/internal/v1/channel'), function () {
    Route::get('count', ['as' => 'channel_count', 'uses' => 'ChannelController@channel_count']);
});

route::group(array('prefix' => 'api/internal/v1/'), function () {
    Route::get('announcement', ['as' => 'get_announcement', 'uses' => 'FrontEnd\V2\AnnouncementController@get_announcement']);
});

route::group(array('prefix' => 'api/private/v2/billing', 'before' => 'internal_api_allowed_hosts|correct_internal_api_key'),  function () {
    Route::get('mail_security_status', ['as' => 'mail_security_status', 'uses' => 'API\PrivateApi\V2\Billing\BillingController@mail_security_status']);
});

// End of Internal API

/* External API */

$api_routes = function () {


    // Public API subjected to rate limit
    Route::group(['before' => 'rl_api_public'], function () {


        //Mobiel App API
        route::group(['prefix' => 'api/v1/dynamo', 'before' => 'correct_user_hash'], function () {
            route::get('active_channels', ['uses' => 'API\DynamoController@index']);
            route::get('dyn_prefs', ['uses' => 'API\DynamoController@dyn_prefs']);
            route::get('update', ['uses' => 'API\DynamoController@update']);
            //JS Mobile
            route::get('js_mobile_channels', ['uses' => 'API\DynamoController@js_mobile_channels']);
            route::get('js_mobile_channels_options', ['uses' => 'API\DynamoController@js_mobile_channels_options']);
        });

        route::group(array('prefix' => 'api/v1/session', 'before' => ['rl_api_public_auth']), function () {

            /*** Login API ***/
            route::post('authenticate', array('uses' => 'API\SessionController@authenticate'));
            route::get('authenticate', array('uses' => 'API\SessionController@authenticate'));

        });


        route::group(array('prefix' => 'api/v1/unohelper'), function () {

            /*** Login API ***/
            route::get('version_check', array('uses' => 'API\WinHelperController@version_check'));
            route::get('get_dns_servers', array('uses' => 'API\WinHelperController@get_dns_servers'));

        });


        route::group(array('prefix' => 'api/v1/sub'), function () {

            //json padded response account status based on IP
            Route::get('account_status', ['uses' => 'API\SubController@get_account_status']);

        });

        route::group(array('prefix' => 'api/v0/sub'), function () {

            //json padded response account status based on IP
            Route::get('account_status', ['uses' => 'API\SubController@get_account_status_legacy']);

        });


        route::group(array('prefix' => 'api/v1/network'), function () {

            /* Update API accepts Get and Put requests */
            route::get('update', array('uses' => 'API\NetworkController@update'));
            route::put('update', array('uses' => 'API\NetworkController@update'));
            route::get('reset_api_calls', array('uses' => 'API\NetworkController@reset_api_calls'));

            //Hash IP Update
            route::get('update_by_hash_api', array('uses' => 'API\NetworkController@update_by_hash_api'));

            route::post('update_by_hash_api', array('uses' => 'API\NetworkController@update_by_hash_api'));

            /* Get Networks */
            route::get('get_networks', array('uses' => 'API\NetworkController@get_networks'));


            /* WinUnoHelper Legacy */
            route::get('l_auth', ['before' => 'internal_api_allowed_hosts|correct_internal_api_key', 'uses' => 'API\WinHelperController@l_auth']);
            route::get('l_get_networks', ['before' => 'internal_api_allowed_hosts|correct_internal_api_key', 'uses' => 'API\WinHelperController@l_get_networks']);
            route::get('l_find_uid_by_nid', ['before' => 'internal_api_allowed_hosts|correct_internal_api_key', 'uses' => 'API\WinHelperController@l_find_uid_by_nid']);
            route::get('l_update_ip', ['before' => 'internal_api_allowed_hosts|correct_internal_api_key', 'uses' => 'API\WinHelperController@l_update_ip']);
            route::get('l_get_network', ['before' => 'internal_api_allowed_hosts|correct_internal_api_key', 'uses' => 'API\WinHelperController@l_find_network_by_nid']);
            route::get('l_get_user', ['before' => 'internal_api_allowed_hosts|correct_internal_api_key', 'uses' => 'API\WinHelperController@l_get_user']);
        });
    });


    route::group(array('prefix' => 'api/v1/dyndns'), function () {

        /*** Login API ***/
        Route::get('dyndns_update', ['before' => '', 'as' => '', 'uses' => 'DynDnsController@dyndns_update']);

    });

    route::group(array('prefix' => 'api/v1/whmcs', 'before' => 'internal_api_allowed_hosts|correct_internal_api_key'), function () {

        /*** Create Subscription ***/
        Route::post('create_sub', ['uses' => 'API\SubController@create_sub']);
        Route::post('unsuspend', ['uses' => 'API\SubController@unsuspend']);
        Route::post('suspend', ['uses' => 'API\SubController@suspend']);
        Route::post('init_sub', ['uses' => 'API\SubController@init_sub']);
        Route::post('extend_trial', ['uses' => 'API\SubController@extend_trial']);
        Route::post('find_user_hash', ['uses' => 'API\SessionController@find_user_hash']);
        Route::post('find_pw_hash', ['uses' => 'API\SessionController@find_pw_hash']);
        Route::post('session_code_auth', ['uses' => 'API\SessionController@session_code_auth']);
        Route::post('is_cc_update_excessive', ['uses' => 'API\SubController@is_cc_update_excessive']);
        Route::post('remove_ip_ban', ['uses' => 'API\SubController@remove_ip_ban']);
        Route::get('is_ip_banned', ['uses' => 'API\SubController@is_ip_banned']);
        Route::get('show_recaptcha', ['uses' => 'FrontEnd\V2\RatelimitController@show_cc_update_recaptcha']);

    });


    // Public APIs
    route::group(['prefix' => 'api/public', 'before' => 'rl_api_public'], function () {

        // Version 1
        route::group(['prefix' => 'v2'], function () {

            // Dynamo API
            route::group(['prefix' => 'dynamo'], function () {
                route::get('dynamo_channels', ['before' => 'rl_api_public_auth|api_user_token_auth', 'uses' => 'API\PublicApi\V2\DynamoController@get_dynamo_channels']);
                route::post('update', ['before' => 'rl_api_public_auth|api_user_token_auth', 'uses' => 'API\PublicApi\V2\DynamoController@post_update_dynamo']);
            });

            // End of Dynamo API
        });
        // End of Version 1

    });
    // End of Public APIs
};


/*
    Wrap different section of routes into anonmyous functions to separate access
    to different routes.
*/

$main_routes();

// TODO: remove from production
if (!App::environment('production'))
    $api_routes();

route::group(['domain' => 'api.' . $domain, 'before' => ''], function () use ($api_routes) {
    return $api_routes();
});





// --
// Web Front End Routes


/***  Debug routes; can be removed. ***/




if(GeneralHelper::is_debug_on()) {
    // Route::get('log', function() {
    //     $a = new UnoTelly\ExtLogger();
    //     $basic_info = $a->get_basic_info();
    //     $a->log_message(1, 'hello', json_encode($basic_info));
    //     $a->fex;
    // });

    // route::get('env', function () {
    //     $env = App::environment();
    //     echo $env;
    //     echo phpinfo();
    // });

    // Route::get('log', function() {
    //     User::create
    // });

}




Route::group(['prefix' => 'new_web'], function () {
    // route groups





    //Work in Progress Routes
    /*** initial setup wizard ***/
    Route::get('setup_wizard', ['as' => 'setup_wizard', 'uses' => 'FrontEnd\V2\SetupWizardController@get_setup_wizard_devices']);

    // NOTE: renamed this route to "setup_wizard_with_parameters" as we cannot have two named routes with the same name
    Route::get('setup_wizard/step2/{id}/{instruction_type}', ['as' => 'setup_wizard_with_parameters', 'uses' => 'FrontEnd\V2\SetupWizardController@setup_wizard_step2']);

    Route::get('setup_wizard/step1', ['as' => 'setup_step1', 'uses' => 'FrontEnd\V2\SetupWizardController@step1']);
    Route::get('setup_wizard/step2', ['as' => 'setup_step2', 'uses' => 'FrontEnd\V2\SetupWizardController@step2']);

    Route::get('quickstart/troubleshoot', ['as' => 'troubleshoot', 'uses' => 'FrontEnd\V2\QuickstartController@get_troubleshoot']);
    //End of Work in progress routes


});


/***   End of Debug Routes ***/



/*** Email Preview crude version before implement full admin ***/

Route::get('/test/email/preview/{template_code}', function ($template_code) {

    $pass_input = Input::get('password');
    $email = Input::get('email');
    $firstname = Input::get('firstname');
    $action = strtolower(Input::get('action'));

    $pass_stored = 'bus2012';
    if ($pass_input !== $pass_stored) {
        return App::abort('404');
    }

    $options = [
        'email' => $email,
        'firstname' => $firstname,
        'title' => 'Welcome to UnoTelly!',
        'trial_expiry_date' => 'June/4/2014',
        'title' => 'Welcome to UnoTelly!'

        //... pass in all params ../
    ];

    $mail = new MailService($template_code);

    if ($action === 'send') {
        $mail->queue($options);
        return 'Test email sent.';
    }

    return $mail->preview($options);
});

/*** End Email Preview ***/