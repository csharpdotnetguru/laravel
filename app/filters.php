<?php

use DynDnsRepositoryInterface as DynDnsInterface;

/*
|--------------------------------------------------------------------------
| Application & Route Filters
|--------------------------------------------------------------------------
|
| Below you will find the "before" and "after" events for the application
| which may be used to do any work before or after a request into your
| application. Here you may also register your custom route filters.
|
*/




App::before(function($request)
{
	//
});


App::after(function($request, $response)
{
	//
});

/*
|--------------------------------------------------------------------------
| Authentication Filters
|--------------------------------------------------------------------------
|
| The following filters are used to verify that the user of the current
| session is logged into this application. The "basic" filter easily
| integrates HTTP Basic authentication for quick, simple checking.
|
*/


Route::filter('correct_internal_api_key', function() {
    $correct_key = Config::get('app.api_key');
    $incoming_key = Input::get('api_key');
   
    if($incoming_key != $correct_key)
    {
        App::abort(401, 'Error');
    }
});

Route::filter('internal_api_allowed_hosts', function()
{
    $allowed_hosts = Config::get('app.allowed_hosts');
    
    $incoming_ip = $_SERVER['REMOTE_ADDR'];
    $result = in_array($incoming_ip, $allowed_hosts);
    if ($result !== TRUE)
    {
        App::abort(401, 'Error');
    }
});

Route::filter('auth', function()
{
	if (Auth::guest()) return Redirect::guest('login');
});


Route::filter('auth.basic', function()
{
	return Auth::basic();
});

/*
|--------------------------------------------------------------------------
| Guest Filter
|--------------------------------------------------------------------------
|
| The "guest" filter is the counterpart of the authentication filters as
| it simply checks that the current user is not logged in. A redirect
| response will be issued if they are, which you may freely change.
|
*/

Route::filter('guest', function()
{
	if (Auth::check()) return Redirect::to('/');
});

/*
|--------------------------------------------------------------------------
| CSRF Protection Filter
|--------------------------------------------------------------------------
|
| The CSRF filter is responsible for protecting your application against
| cross-site request forgery attacks. If this special token in a user
| session does not match the one given in this request, we'll bail.
|
*/

Route::filter('csrf', function()
{
	if (Session::token() != Input::get('_token'))
	{
		throw new Illuminate\Session\TokenMismatchException;
	}
});


/*********

Filters
 * Guest filter will return none authenticated clients to the login
 *screen.
 *
 * Member filter will redirect members to the index of the user section
 * this is triggered when ever a member goes to a guest page when they are already logged in
 *
 *
 * Admin filter
 * this will redirect any none admin roles to the admin login page if they are not authenticated as admin user
 *
 *
 *
 **********/


//Route filter for dynamo api

Route::filter('correct_user_hash', function() {
    $user_hash = Input::get('user_hash');
    $uid = Authenticate::correct_user_hash($user_hash);
    if ( $uid === NULL ) {
        return Response::json(array(
            'status' => 0,
            'msg' => 'Wrong user hash key'
        ), 200)->setCallBack(Input::get('callback')); // Changed response code to 200
    }
});

//this route for people not logged in
Route::filter('is_guest', function ($route) {

    if (!($uid = Authenticate::guest())) {
        return Redirect::route('quickstart_index');
    }
});

//this route for people logged in
Route::filter('is_member', function ($route) {

    if (!(Authenticate::is_logged_in())) {
        // Changed from Redirect:route to Redirect::guest
        // so that the intended location is saved in session
        //return Redirect::guest('login');
        return Authenticate::custom_redirect_guest('session_login'); //Using custom redirect function to allow named route redirect
    }
});

Route::filter('has_cookies', function($route) {
     Authenticate::check_cookie_login();
});


Route::filter('correct_user', function ($route) {

    $uid = $route->getParameter('uid'); // can take a default as well

    if (!Authenticate::correct_user($uid)) {
        // App::abort(401, 'You are not authorized.');
        return Redirect::route('session_login');

    }
});

Route::filter('correct_network', function ($route) {
    // Get uid parameter from session instead of URL
    $uid = Authenticate::get_uid();
    $network_id = $route->getParameter('network_id');

    if (!Authenticate::correct_network($uid, $network_id)) {
        // App::abort(401, 'You are not authorized');
        return Redirect::route('session_login');

    }
});





Route::filter('admin', function () {
    if (!AdminUserController::isAdmin()) {
        return Redirect::route('admin_login');
    }
});



App::error(function (DefaultNetworkNotFoundException $e)
{
    //do some logging here
    return Response::json($e->getMessage(), $e->getCode());
});

/* Class using IOC container and dependency injection */



Route::filter('correct_dyndns_owner', 'CorrectDynDnsOwner');

Route::filter('rl_api_public_auth', function() {
    $ip = $_SERVER['REMOTE_ADDR'];

    $failure_limit = Config::get('app.rl_api_public_auth_failure_limit');
    $block_length = Config::get('app.rl_api_public_auth_block_legnth');

    $rate_limit = app::make('RateLimitRepositoryInterface');
    $result = $rate_limit->api_login_block($ip, $failure_limit, $block_length);

    if($result !== FALSE) {
        return Response::json([
            'status' => 0,
            'message' => 'Login limit exceeded. Please try again.',
            'data' => [
                'ip' => $ip,
                'failures' => $result['failures'],
                'ttl' => $result['ttl']
            ]
        ], 200)->setCallBack(Input::get('callback'));
    }

});

Route::filter('rl_api_public', function () {
    $uri = Request::path();
    $ip = $_SERVER['REMOTE_ADDR'];
    $interval = Config::get('app.rl_api_public_interval');
    $max_per_interval = Config::get('app.rl_api_public_max_per_interval');
    $rate_limit = app::make('RateLimitRepositoryInterface');
    $key_name = $rate_limit->prefix_api_public . ':' . $uri . ':ip:' .$ip;


    $rate_limit->api_public_incr($ip, $uri);

    $result = $rate_limit->api_public_block($ip, $uri, $max_per_interval, $interval);

    $ttl = $rate_limit->redis->ttl($key_name);


    if($result !== FALSE) {
        return Response::json(array(
            'status' => 0,
            'message' => 'API Rate Limit Exceeded.',
            'data' => [
                'ip' => $result['ip'],
                'count' => $result['count'],
                'ttl' => $result['ttl']
            ]
        ), 200)->setCallBack(Input::get('callback'));
    }

});




Route::filter('force_ssl', function()
{

    if( ! Request::secure() && App::environment() !== 'development' && App::environment() !== 'staging') // change local with the name of your local environment
    {
        return Redirect::secure(Request::getRequestUri());
    }

});


Route::filter('api_user_token_auth', function() {
        $uid_input = trim(Input::get('uid'));
        $user_hash_input = trim(Input::get('user_hash'));

        $uri = Request::path();
        $ip = $_SERVER['REMOTE_ADDR'];


        $rate_limit_interface = app::make('RateLimitRepositoryInterface');
        $user_interface = app::make('UserRepositoryInterface');

        $auth = $user_interface->uid_user_hash_auth($uid_input, $user_hash_input);

        if($auth === FALSE) {
            $rate_limit_interface->api_login_failure_incr($ip, $user_hash_input);
            $rate_limit_interface->record_login_failure($ip, $user_hash_input, $uri);

            $data = [
                'status' => 0,
                'message' => 'Auth Failed. Wrong User Hash.'
            ];

            return Response::json($data, 200)->setCallBack(Input::get('callback'));
        }
        else {
            $rate_limit_interface->api_login_faliure_clear($ip);
        }
});


Route::filter('ip_ban', function() {
    $ip = $_SERVER['REMOTE_ADDR'];
    $rate_limit = app::make('RateLimitRepositoryInterface');
    $result = $rate_limit->is_ip_banned($ip);
    if($result === TRUE) {
        return View::make('v2.frontend.errors.ip_block');
    }
});