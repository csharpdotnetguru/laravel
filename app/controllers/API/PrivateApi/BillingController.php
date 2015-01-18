<?php namespace API\PrivateApi\V2\Billing;



use BaseController;
use Input;
use View;
use Response;
use DynamoRepositoryInterface as DynamoInterface;
use UserRepositoryInterface as UserInterface;
use Request;
use RateLimitRepositoryInterface as RateLimitInterface;
use Log;
use App;
use Mail;

class BillingController extends BaseController 
{
	public function mail_security_status() {
		$billing_interface = App::make('BillingRepositoryInterface');
		$gateway_log = $billing_interface->get_gateway_log_day();	
		$ip_ban = $billing_interface->get_ip_ban_day();
		$login_failures = $billing_interface->get_failed_logins_day();

		$data['gateway_log'] = $gateway_log;
		$data['ip_ban'] = $ip_ban;
		$data['login_failures'] = $login_failures;

	    Mail::queue('v2.frontend.emails.internal.security_status', $data, function($message)
	    {
	        $message->to('nicholas.lin@unovation.com', 'Nick L')->subject('Daily Security Log: '. date("F j, Y, g:i a"));
	        $message->to('andrey.d@unovation.com', 'Andrey D')->subject('Daily Security Log: '. date("F j, Y, g:i a"));
	        $message->to('kobi.k@unovation.com', 'Kobi K')->subject('Daily Security Log: '. date("F j, Y, g:i a"));
	        $message->to('jonathan.d@unovation.com', 'Jonathan D')->subject('Daily Security Log: '. date("F j, Y, g:i a"));
	        $message->to('admin@bigcatcloud.com', 'John Smith')->subject('Daily Security Log: '. date("F j, Y, g:i a"));
	        $message->to('message-27188150-36b85a9a66536d01c94677ce@basecamp.com', 'Base Camp')->subject('Daily Security Log: '. date("F j, Y, g:i a"));
	    
	    });
	}


}