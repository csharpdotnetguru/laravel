<?php

return array(

	/*
		Custom variables - unotelly

	*/

	'graylog_server' => '64.237.43.126',

	'facility' => 'laravel_app',

	'dnsStatusApiLink' => 'https://setupcheckapi.unotelly.com/index.php?callback=?&type=json',

	'accountStatusApiLink' => 'https://api.unotelly.com/api/v1/sub/account_status?callback=?&type=json',

	'max_num_confirm' => 5,

	'mcrypt_key' => '14ccef113a6935b45a30d010c698ee81d3df20c5d9b05fc3d8c00e58580fce64', //development key

	'whmcs_api_url' => 'http://whmcs-dev.unostructure.com:8889/includes/api.php',
	'whmcs_api_username' => 'admin',
	'whmcs_api_password' => 'HnYdCAQEMN',

	
	'login_recaptcha_limit' => 2,
	'signup_recaptcha_limit' => 2,
	'cc_update_max_count' => 7,

	'recaptcha_public_key' => '6LeNgPcSAAAAAPrkC089k_PqoMSchv4NvQRl1Y3F',
	'recaptcha_private_key' => '6LeNgPcSAAAAAGOkmwivwaOUW9sc-tnGrq84CQxp',



	/* Rate Limit */

    'rl_api_public_max_per_interval' => 120, //req/s per api uri
    'rl_api_public_interval' => 60,

    'rl_api_public_auth_failure_limit' => 3, //allow to fail 5 times before block
    'rl_api_public_auth_block_legnth' => 120, //seconds to block after 5 times failure

	/* End of Rate Limit*/


	'api_key' => 'test123',

	'domain' => 'unotelly.dev',

	'whmcs_url' => 'http://whmcs-dev.unostructure.com:8889',

    //set the target user as a reference user from your local database
    'test_params' => [
        'uid' => 3,
        'firstname' => 'Darth',
        'lastname' => 'Vader',
        'email' => 'darth.vader@unotelly.com',
        'password' => 'test123',
        'password_hash' => 'afe0b9d0134300f7854b91f5e69bcc70:mOibd',
        'session_code_success' => '11337d1d63de5706001510b59551a39e', //set created_at time to 2024 so test will pass or the session code will be expired already
        'session_code_fail' => '9031aaf5e0b7cac4c5e417e6fef80248', //already expired code ; set created_at to older 120 second of current time
    	'user_hash' => 'cb08baf27df3872de174e25ed55e88c1',
    	'channel_id' => '4',
    	'country_id' => '1',
    	'pkg_uniq_id' => 'prem_365',
    	'product_id' => '777',
    	'my_ip' => '127.0.0.1'
    ],

    //set secondary target user as a reference user from your local database
    'test_params_secondary' => [
        'uid' => 421344,
        'firstname' => 'Anakin',
        'lastname' => 'Skywalker',
        'email' => 'anakin.skywalker@unotelly.com',
        'password' => 'test123',
        'password_hash' => 'c5941ae4b0f78017f05a78b943128e6a:DpGeu',
        'session_code_success' => '11337d1d63de5706001510b59551a39e', //set created_at time to 2024 so test will pass or the session code will be expired already
        'session_code_fail' => '9031aaf5e0b7cac4c5e417e6fef80248', //already expired code ; set created_at to older 120 second of current time
    	'user_hash' => 'cb08baf27df3872de174e25ed55e88c1',
    	'channel_id' => '4',
    	'country_id' => '2',
    	'pkg_uniq_id' => 'prem_365',
    	'product_id' => '777'
    ],

    'allowed_hosts' => [
        '::1', 'php://temp', '127.0.0.1' , // local
        '108.61.44.138', // TODO: ???
        '5.4.3.2', // TODO: ???
        '99.237.184.198', // TODO: ???
        '69.165.248.208', // TODO: ???
        '24.75.178.20', // tom
        '64.237.43.126', // staging
        '64.237.43.124' // staging-quickstart3
    ],


    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

	'debug' => true,

	/*
	|--------------------------------------------------------------------------
	| Application URL
	|--------------------------------------------------------------------------
	|
	| This URL is used by the console to properly generate URLs when using
	| the Artisan command line tool. You should set this to the root of
	| your application so that it is used when running Artisan tasks.
	|
	*/

	'url' => 'http://unotelly.dev',

	/*
	|--------------------------------------------------------------------------
	| Application Timezone
	|--------------------------------------------------------------------------
	|
	| Here you may specify the default timezone for your application, which
	| will be used by the PHP date and date-time functions. We have gone
	| ahead and set this to a sensible default for you out of the box.
	|
	*/

	'timezone' => 'America/Toronto',

	/*
	|--------------------------------------------------------------------------
	| Application Locale Configuration
	|--------------------------------------------------------------------------
	|
	| The application locale determines the default locale that will be used
	| by the translation service provider. You are free to set this value
	| to any of the locales which will be supported by the application.
	|
	*/

	'locale' => 'en',

	/*
	|--------------------------------------------------------------------------
	| Encryption Key
	|--------------------------------------------------------------------------
	|
	| This key is used by the Illuminate encrypter service and should be set
	| to a random, 32 character string, otherwise these encrypted strings
	| will not be safe. Please do this before deploying an application!
	|
	*/

	'key' => 'uXkMplguor62ooxQ7axh7kndWNuQHa6k',

	/*
	|--------------------------------------------------------------------------
	| Autoloaded Service Providers
	|--------------------------------------------------------------------------
	|
	| The service providers listed here will be automatically loaded on the
	| request to your application. Feel free to add your own services to
	| this array to grant expanded functionality to your applications.
	|
	*/

	'providers' => array(

		'Illuminate\Foundation\Providers\ArtisanServiceProvider',
		'Illuminate\Auth\AuthServiceProvider',
		'Illuminate\Cache\CacheServiceProvider',
		'Illuminate\Foundation\Providers\CommandCreatorServiceProvider',
		'Illuminate\Session\CommandsServiceProvider',
		'Illuminate\Foundation\Providers\ComposerServiceProvider',
		'Illuminate\Routing\ControllerServiceProvider',
		'Illuminate\Cookie\CookieServiceProvider',
		'Illuminate\Database\DatabaseServiceProvider',
		'Illuminate\Encryption\EncryptionServiceProvider',
		'Illuminate\Filesystem\FilesystemServiceProvider',
		'Illuminate\Hashing\HashServiceProvider',
		'Illuminate\Html\HtmlServiceProvider',
		'Illuminate\Foundation\Providers\KeyGeneratorServiceProvider',
		'Illuminate\Log\LogServiceProvider',
		'Illuminate\Mail\MailServiceProvider',
		'Illuminate\Foundation\Providers\MaintenanceServiceProvider',
		'Illuminate\Database\MigrationServiceProvider',
		'Illuminate\Foundation\Providers\OptimizeServiceProvider',
		'Illuminate\Pagination\PaginationServiceProvider',
		'Illuminate\Foundation\Providers\PublisherServiceProvider',
		'Illuminate\Queue\QueueServiceProvider',
		'Illuminate\Redis\RedisServiceProvider',
		'Illuminate\Auth\Reminders\ReminderServiceProvider',
		'Illuminate\Foundation\Providers\RouteListServiceProvider',
		'Illuminate\Database\SeedServiceProvider',
		'Illuminate\Foundation\Providers\ServerServiceProvider',
		'Illuminate\Session\SessionServiceProvider',
		'Illuminate\Foundation\Providers\TinkerServiceProvider',
		'Illuminate\Translation\TranslationServiceProvider',
		'Illuminate\Validation\ValidationServiceProvider',
		'Illuminate\View\ViewServiceProvider',
		'Illuminate\Workbench\WorkbenchServiceProvider',

        'Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider',
        'Rocketeer\RocketeerServiceProvider',
        'Jenssegers\Agent\AgentServiceProvider',

    ),

	/*
	|--------------------------------------------------------------------------
	| Service Provider Manifest
	|--------------------------------------------------------------------------
	|
	| The service provider manifest is used by Laravel to lazy load service
	| providers which are not needed for each request, as well to keep a
	| list of all of the services. Here, you may set its storage spot.
	|
	*/

	'manifest' => storage_path().'/meta',

	/*
	|--------------------------------------------------------------------------
	| Class Aliases
	|--------------------------------------------------------------------------
	|
	| This array of class aliases will be registered when this application
	| is started. However, feel free to register as many as you wish as
	| the aliases are "lazy" loaded so they don't hinder performance.
	|
	*/

	'aliases' => array(

        'App'             => 'Illuminate\Support\Facades\App',
        'Artisan'         => 'Illuminate\Support\Facades\Artisan',
        'Auth'            => 'Illuminate\Support\Facades\Auth',
        'Blade'           => 'Illuminate\Support\Facades\Blade',
        'Cache'           => 'Illuminate\Support\Facades\Cache',
        'ClassLoader'     => 'Illuminate\Support\ClassLoader',
        'Config'          => 'Illuminate\Support\Facades\Config',
        'Controller'      => 'Illuminate\Routing\Controller',
        'Cookie'          => 'Illuminate\Support\Facades\Cookie',
        'Crypt'           => 'Illuminate\Support\Facades\Crypt',
        'DB'              => 'Illuminate\Support\Facades\DB',
        'Eloquent'        => 'Illuminate\Database\Eloquent\Model',
        'Event'           => 'Illuminate\Support\Facades\Event',
        'File'            => 'Illuminate\Support\Facades\File',
        'Form'            => 'Illuminate\Support\Facades\Form',
        'Hash'            => 'Illuminate\Support\Facades\Hash',
        'HTML'            => 'Illuminate\Support\Facades\HTML',
        'Input'           => 'Illuminate\Support\Facades\Input',
        'Lang'            => 'Illuminate\Support\Facades\Lang',
        'Log'             => 'Illuminate\Support\Facades\Log',
        'Mail'            => 'Illuminate\Support\Facades\Mail',
        'Paginator'       => 'Illuminate\Support\Facades\Paginator',
        'Password'        => 'Illuminate\Support\Facades\Password',
        'Queue'           => 'Illuminate\Support\Facades\Queue',
        'Redirect'        => 'Illuminate\Support\Facades\Redirect',
        'RedisL4'           => 'Illuminate\Support\Facades\Redis',
        'Request'         => 'Illuminate\Support\Facades\Request',
        'Response'        => 'Illuminate\Support\Facades\Response',
        'Route'           => 'Illuminate\Support\Facades\Route',
        'Schema'          => 'Illuminate\Support\Facades\Schema',
        'Seeder'          => 'Illuminate\Database\Seeder',
        'Session'         => 'Illuminate\Support\Facades\Session',
        'SSH'             => 'Illuminate\Support\Facades\SSH',
        'Str'             => 'Illuminate\Support\Str',
        'URL'             => 'Illuminate\Support\Facades\URL',
        'Validator'       => 'Illuminate\Support\Facades\Validator',
        'View'            => 'Illuminate\Support\Facades\View',

        'Rocketeer'       => 'Rocketeer\Facades\Rocketeer',
        'Agent'           => 'Jenssegers\Agent\Facades\Agent',

    ),

);
