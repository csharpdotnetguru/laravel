<?php namespace API;

use BaseController;
use Input;
use View;
use Response;
use SubRepositoryInterface as SubInterface;
use Request;
use App;

class SubController extends BaseController {

	public function __construct(SubInterface $sub_interface)
    {
    	$this->sub_interface = $sub_interface;
    }

    public function unsuspend()
    {
        $uid = Input::get('uid');
        $status = 'active';
        $result = $this->sub_interface->change_status($uid, $status);

        if( $result === false ) {
            return Response::json(
                [
                    'status' => 0,
                    'data' => [
                        'message' => 'Failed to unsuspend subscription.'
                    ]
                ]
            );
        }

        return Response::json(
                [
                    'status' => 1,
                    'data' => [
                        'message' => 'Subscrption unsuspended.'
                    ]
                ]
        );
    }

    public function suspend()
    {
        $uid = Input::get('uid');
        $status = 'inactive';
        $result = $this->sub_interface->change_status($uid, $status);

        if( $result === false ) {
            return Response::json(
                [
                    'status' => 0,
                    'data' => [
                        'message' => 'Failed to suspend subscription.'
                    ]
                ]
            );
        }

        return Response::json(
                [
                    'status' => 1,
                    'data' => [
                        'message' => 'Subscrption suspended.'
                    ]
                ]
        );
    }

    public function create_sub()
    {
    	$uid = Input::get('uid');
    	$sub_length = Input::get('sub_length');
    	$product_id = Input::get('product_id');
    	$product_type = Input::get('product_type');

    	$result = $this->sub_interface->create_sub($uid, $sub_length, $product_id, $product_type);


    	if( $result === false ) {
    		return Response::json(
    			[
	    			'status' => 0,
	    			'data' => [
	    				'message' => 'Failed to create/update subscription.'
	    			]
    			]
    		);
    	}

    	return Response::json(
    			[
	    			'status' => 1,
	    			'data' => [
	    				'message' => 'Subscrption created or updated.'
	    			]
    			]
    	);

    }


    public function test_sub()
    {
        $a = $this->sub_interface->init_sub(3, 'prem_365');
        var_dump($a) ;
    }


    public function init_sub()
    {
        $uid = Input::get('uid');
        $pkg_uniq_id = Input::get('pkg_uniq_id');
        $product_id = Input::get('product_id');

        $result = $this->sub_interface->init_sub($uid, $pkg_uniq_id, $product_id);

        if( is_object($result) ) {
            $end_time =  date('M/d/Y', $result->endTime);
            $message = 'Subscription created.';
        }
        else {
            $end_time = date('M/d/Y', $result);
            $message = 'Subscription updated.';

        }


        if( $result === FALSE ) {
            return Response::json(
                [
                    'status' => 0,
                    'data' => [
                        'message' => 'Failed to create/update subscription.'
                    ]
                ]
            );
        }


        return Response::json(
                [
                    'status' => 1,
                    'data' => [
                        'message' => $message,
                        'end_time' => $end_time
                    ]
                ]
        );

    }

    public function extend_trial()
    {
        $uid = Input::get('uid');
        $result = $this->sub_interface->extend_trial($uid);

        if( $result === FALSE ) {
            return Response::json(
                [
                    'status' => 0,
                    'data' => [
                        'message' => 'Failed to extend trial.'
                    ]
                ]
            );
        }

        return Response::json(
                [
                    'status' => 1,
                    'data' => [
                        'message' => 'Trial Extended.'
                    ]
                ]
        );
    }

    public function get_account_status()
    {

        $callback = Input::get('callback');
        $ip = Request::getClientIp();

        if (Input::has('email_not_confirmed')) {
            $response = $this->sub_interface->assemble_ajax_account_status($ip, false);
        } else {
            $response = $this->sub_interface->assemble_ajax_account_status($ip);
        }

        $account_status = json_encode($response);

        return $callback . '(' . $account_status . ');';

    }


    public function get_account_status_legacy()
    {

        $callback = Input::get('callback');
        $type = Input::get('type');
        $ip = Request::getClientIp();


        $account_status = json_encode($this->sub_interface->assemble_ajax_account_status_legacy($ip));

        return $callback . '(' . $account_status . ');';

    }


    public function is_cc_update_excessive() {
        $uid = Input::get('uid');
        $ip = Input::get('ip');


        $user_interface = App::make('UserRepositoryInterface');
        $insert_result =  $user_interface->insert_update_cc($uid, $ip);
        $insert_result2 =  $user_interface->insert_recaptcha_update_cc($uid, $ip);



        $rate_limit_interface = App::make('RateLimitRepository');
        $result = $rate_limit_interface->is_cc_update_excessive($uid, $ip);

        if( $result === FALSE ) {
            return Response::json(
                [
                    'status' => 0,
                    'data' => [
                        'message' => 'IP not blocked due to excessive cc update'
                    ]
                ]
            );
        }

        return Response::json(
                [
                    'status' => 1,
                    'data' => [
                        'message' => 'IP blocked due to excessive cc update.'
                    ]
                ]
        );
    }


    public function remove_ip_ban() {
        $ip = trim(Input::get('ip'));

        $rate_limit_interface = App::make('RateLimitRepository');
        $result = $rate_limit_interface->remove_ip_ban($ip);

        if( $result === FALSE ) {
            return Response::json(
                [
                    'status' => 0,
                    'data' => [
                        'message' => 'Failed to remove ban. Please contact Level 2'
                    ]
                ]
            );
        }

        return Response::json(
                [
                    'status' => 1,
                    'data' => [
                        'message' => 'IP Ban '. $ip .' removed. Please ask customer to try again.'
                    ]
                ]
        );
    }


    public function is_ip_banned() {
        $ip = trim(Input::get('ip'));

        $rate_limit_interface = App::make('RateLimitRepository');
        $result = $rate_limit_interface->is_ip_banned($ip);

        if( $result === FALSE ) {
            return Response::json(
                [
                    'status' => 0,
                    'data' => [
                        'message' => 'IP not banned.'
                    ]
                ]
            );
        }

        return Response::json(
                [
                    'status' => 1,
                    'data' => [
                        'message' => 'IP Banned. Deny Access'
                    ]
                ]
        );
    }

}