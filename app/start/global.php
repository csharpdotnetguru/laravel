<?php

/*
|--------------------------------------------------------------------------
| Register The Laravel Class Loader
|--------------------------------------------------------------------------
|
| In addition to using Composer, you may use the Laravel class loader to
| load your controllers and models. This is useful for keeping all of
| your classes in the "global" namespace without Composer updating.
|
*/

ClassLoader::addDirectories(array(

	app_path().'/commands',
	app_path().'/controllers',
	app_path().'/models',
	app_path().'/database/seeds',

));

/*
|--------------------------------------------------------------------------
| Application Error Logger
|--------------------------------------------------------------------------
|
| Here we will configure the error logger setup for the application which
| is built on top of the wonderful Monolog library. By default we will
| build a rotating log file setup which creates a new file each day.
|
*/

$logFile = 'log-'.php_sapi_name().'.txt';

Log::useDailyFiles(storage_path().'/logs/'.$logFile);

/*
|--------------------------------------------------------------------------
| Application Error Handler
|--------------------------------------------------------------------------
|
| Here you may handle any errors that occur in your application, including
| logging them or displaying custom views for specific errors. You may
| even register several error handlers to handle different types of
| exceptions. If nothing is returned, the default error view is
| shown, which includes a detailed stack trace during debug.
|
*/

App::error(function(Exception $exception, $code)
{
    $uno_logger = new UnoTelly\ExtLogger();
    $basic_info = $uno_logger->get_basic_info();

    $full_message = json_encode($basic_info) . $exception->getTraceAsString();
    $short_message = $exception->getMessage();

    if(strlen($short_message) == 0) {
        $short_message = 'Missing Short Message';
    }

    Log::error($full_message);

    $uno_logger->log_message(2, $short_message, $full_message);

    if(!GeneralHelper::is_debug_on()) {
        return View::make('v2.frontend.errors.fatal_error');
    }
});

/*
|--------------------------------------------------------------------------
| Maintenance Mode Handler
|--------------------------------------------------------------------------
|
| The "down" Artisan command gives you the ability to put an application
| into maintenance mode. Here, you will define what is displayed back
| to the user if maintenace mode is in effect for this application.
|
*/

App::down(function()
{
	return Response::make("Be right back!", 503);
});



App::missing(function ($exception) {
    if (App::environment('production')) {
        $uno_logger = new UnoTelly\ExtLogger();
        $basic_info = $uno_logger->get_basic_info();

        $short_message = '404 Not Found';
        $full_message = '404 Not Found: ' . json_encode($basic_info);

        Log::info($full_message);

        $uno_logger->log_message(1, $short_message, $full_message);
        return Redirect::route('home');
    }
});


// If debug is on, log SQL queries to artisan serve
DB::listen(function($sql, $bindings, $time)
{
    if (App::environment('development')) {
        $data = "[SQL] {$sql} \n" .
            "      bindings:\t".json_encode($bindings)."\n".
            "      time:\t{$time} milliseconds\n";

        // console
        file_put_contents('php://stdout', $data);

        //logs
        Log::info($data);
    }
});


/*
|--------------------------------------------------------------------------
| Require The Filters File
|--------------------------------------------------------------------------
|
| Next we will load the filters file for the application. This gives us
| a nice separate location to store our route and application filter
| definitions instead of putting them all in the main routes file.
|
*/

require app_path().'/filters.php';