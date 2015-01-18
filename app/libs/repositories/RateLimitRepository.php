<?php

class RateLimitRepository implements RateLimitRepositoryInterface 
{

	public function __construct() {
		$this->redis = RedisL4::connection();
		$this->prefix_login_faliure_ip = 'RL:api:login:failure:ip';
		$this->prefix_api_public = 'RL:api:public';
	}


/**
 * [api_login_block increment user login failure and block if failure reached]
 * @param  [string] $ip            [user ip]
 * @param  [int] $failure_limit [max. number of fail login allowed]
 * @param  [int] $block_length  [block in seconds]
 * @return [MIXED]                [if blocked, return current ttl of block and number of fail attempts]
 */
	public function api_login_block($ip, $failure_limit, $block_length) {
		
		$key_name = $this->prefix_login_faliure_ip . ':' . $ip;

		$stored_failures = $this->redis->hget($key_name, 'failures');

		if($stored_failures >= $failure_limit) {
		    $ttl = $this->redis->ttl($key_name);

		    if($ttl < 0) { //only set block expire if user block is not in place
		        $expire = $this->redis->expire($key_name, $block_length);
			    $ttl = $this->redis->ttl($key_name);
		    } 

		    Log::info('Login Failure Exceeded. Blocked IP: ' . $ip);

		    return [
		    	'failures' => $stored_failures,
		    	'ttl' => $ttl
		    ];
		}

		Log::info('Login Failure under limit.');

		return FALSE;
	}


	public function api_login_failure_incr($ip, $email) {
		$key_name = $this->prefix_login_faliure_ip . ':' . $ip;
		$result = $this->redis->hset($key_name, "email", $email);
		$result2 = $this->redis->hincrby($key_name, 'failures', 1);
		Log::info('Increase login failure block for ip: ' . $ip);

	}

	public function api_login_faliure_clear($ip) {
		$key_name = $this->prefix_login_faliure_ip . ':' . $ip;
		Log::info('Clearing api login failure block for ip: ' . $ip);
		return $this->redis->DEL($key_name);		
	}


	public function api_public_block($ip, $uri, $max_per_interval, $interval) {

		$key_name = $this->prefix_api_public . ':' . $uri . ':ip:' .$ip;
		/* string 'RL:api:public:api_public:ip:1.2.3.4' (length=35) */

		$stored_count = $this->redis->hget($key_name, 'count');
		$ttl = $this->redis->ttl($key_name);

		// echo 'current ttl is ' . $ttl;
		// echo "<br />";

		if($ttl < 0) { //only set block expire if user block is not in place
			$expire = $this->redis->expire($key_name, $interval);
			$ttl = $this->redis->ttl($key_name);
		} 	

		if($stored_count >= $max_per_interval) {
		    return $result = [
		    	'ip' => $ip,
		    	'count' => $stored_count,
		    	'ttl' => $ttl
		    ];

		}

		return FALSE;
		
	}

	public function api_public_incr($ip, $uri) {
		Log::info('Increase API access count for ip: ' . $ip);

		$key_name = $this->prefix_api_public . ':' . $uri . ':ip:' .$ip;
		$this->redis->hset($key_name, 'ip', $ip);
		$this->redis->hincrby($key_name, 'count', 1);
	}

	public function api_public_block_clear($ip, $uri) {
		Log::info('Clearing general api block for ip: ' . $ip);

		$key_name = $this->prefix_api_public . ':' . $uri . ':ip:' .$ip;
		return $this->redis->DEL($key_name);		
	}


	public function record_login_failure($ip, $email, $path) {

		Log::info('Recording login failure to db ip: ' . $ip);

		$data = [
			'ip' => $ip,
			'email' => $email,
			'path' => $path
		];
		return LoginFailure::create($data);
	}

	public function insert_ip_ban($ip) {
    	$result = IpBan::where('ip','=',$ip)->get();
    	$count = $result->count();
    	if($count <= 0) {
			return IpBan::create(['ip' => $ip, 'status' => 1]);
    	}

    	else if($result->first()->status == 0) {
    		$record = IpBan::find($ip);
    		$record->status = 1;
    		return $record->save();
    	}
	}

    public function select_update_cc_count($ip) {
        $count = UpdateCc::where('ip', '=', $ip)->get()->count();
        return $count;
    }


    public function select_recaptcha_update_cc_count($ip) {
        $count = UpdateCcRecaptcha::where('ip', '=', $ip)->get()->count();
        return $count;
    }


    public function is_cc_update_excessive($uid, $ip) {
    	$max_count = Config::get('app.cc_update_max_count');   
    	$count = $this->select_update_cc_count($ip);
    	if($count >= $max_count) {
    		return $this->insert_ip_ban($ip);
    	}
    	return FALSE;
    }

    public function is_ip_whitelist($ip) {
    	$count = IpWhiteList::where('ip', '=', $ip)->get()->count();
    	if($count>0) {
    		return TRUE;
    	}
    	return FALSE;
    }

    public function is_ip_banned($ip) {
    	$count = IpBan::where('ip','=',$ip)->where('status', '=', 1)->get()->count();
    	
    	//check ip whitelist
    	$whitelist = $this->is_ip_whitelist($ip);

    	if($whitelist === TRUE) {
    		return FALSE;
    	}

    	if($count >0) {
    		return TRUE;
    	}
    	return FALSE;
    }

    public function remove_ip_ban($ip) {
    	$record = IpBan::find($ip);
    	$record->status = 0;
    	UpdateCc::where('ip', '=', $ip)->delete();
    	return $record->save();
    }


    public function show_recaptcha($ip, $max_count) {
    	$count = $this->select_recaptcha_update_cc_count($ip);
    	if($count >= $max_count) {
    		return TRUE;
    	}
    	return FALSE;
    }

    public function reduce_cc_recaptcha($ip) {
        return UpdateCcRecaptcha::where('ip', '=', $ip)->limit(1)->delete();
    }

    public function multiple_signups_same_ip() {
    	$ip = $_SERVER['REMOTE_ADDR'];

    	$current_time = new DateTime();
    	$cutoff_time = $current_time->sub(new DateInterval('PT5M'));

    	$max_count = Config::get('app.signup_recaptcha_limit');   

		$result =  Network::where('client_ip', '=', $ip)->where('created_at', '>=', $cutoff_time)->get()->count();
		
		//var_dump($result);

		if($result >= $max_count) {
			return TRUE;
		}
		return FALSE;

    }

    public function solve_recaptcha() {

		require_once(app_path().'/libs/recaptchalib.php');
		$privatekey = Config::get('app.recaptcha_private_key');

		// Fields must be set
		if(! isset($_POST['recaptcha_challenge_field']) ) {
			return FALSE;
		}
		
		$resp = recaptcha_check_answer ($privatekey,
										$_SERVER["REMOTE_ADDR"],
										$_POST["recaptcha_challenge_field"],
										$_POST["recaptcha_response_field"]);
		if (!$resp->is_valid) {
            return FALSE;
        }
        return TRUE;
    }

    public function login_fail_recaptcha() {

     	$ip = $_SERVER['REMOTE_ADDR'];

    	$current_time = new DateTime();
    	$cutoff_time = $current_time->sub(new DateInterval('PT5M'));
    	$max_count = Config::get('app.login_recaptcha_limit');    
		$result =  LoginFailure::where('ip', '=', $ip)->where('created_at', '>=', $cutoff_time)->get()->count();
		
		if($result >= $max_count) {
			return TRUE;
		}
		return FALSE;
    }

    public function can_send_confirm($uid) {
    	$num_confirm = User::where('id', '=', $uid)->get()->first()->num_confirm_sent;
    	$max_confirm = Config::get('app.max_num_confirm');
    	if($num_confirm < $max_confirm) {
    		return TRUE;
    	}
    	return FALSE;
    }
}