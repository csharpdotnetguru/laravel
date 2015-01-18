<?php

class EloquentBillingRepository implements BillingRepositoryInterface 
{
	public function get_gateway_log_day() {
		$today_date = date('j,n,Y');
		$today_date_array = explode(',', $today_date);
		$day = $today_date_array[0];
		$month = $today_date_array[1];
		$year = $today_date_array[2];

		$fail_result = DB::connection('unotelly_billing')
		->select('select * from tblgatewaylog where day(date) = ? and month(date) = ? and year(date) =? and result = ?', [$day,$month,$year, 'Declined'] );

		$all_result = DB::connection('unotelly_billing')
		->select('select * from tblgatewaylog where day(date) = ? and month(date) = ? and year(date) =?', [$day,$month,$year] );


		$fail_count = count($fail_result);
		$all_count = count($all_result);

		$data['fail_count'] = $fail_count;
		$data['all_count'] = $all_count;

		return $data;
	}

	public function get_ip_ban_day() {
		$today_date = date('j,n,Y');
		$today_date_array = explode(',', $today_date);
		$day = $today_date_array[0];
		$month = $today_date_array[1];
		$year = $today_date_array[2];

		$result = DB::connection('unotelly_portal')
		->select('select * from ip_ban where day(created_at) = ? and month(created_at) = ? and year(created_at) =?', [$day,$month,$year] );
		
		$data['ban_count'] = count($result);
		$data['ips'] = $result;
		return $data;
	}

	public function get_failed_logins_day() {
		$today_date = date('j,n,Y');
		$today_date_array = explode(',', $today_date);
		$day = $today_date_array[0];
		$month = $today_date_array[1];
		$year = $today_date_array[2];

		$result = DB::connection('unotelly_portal')
		->select('select * from z_login_failures where day(created_at) = ? and month(created_at) = ? and year(created_at) =?', [$day,$month,$year] );
		
		$data['login_failures_count'] = count($result);
		$data['login_failures'] = $result;
		return $data;		
	}

	public function auth_whmcs($email, $password) {
		$postfields['action'] = 'validatelogin';
		$postfields['email'] = $email;
		$postfields['password2'] = $password;

		$result = $this->connect_whmcs_api($postfields);

		if($result->result != 'success'){

			if($result->message == 'Email or Password Invalid') {
				return FALSE;
			}
			
			throw new WhmcsApiErrorException(
				'ErrorMsg: '
				. $result->message
				. ' action: '
				. $postfields['action']
				. ' email: '
				. $postfields['email'] 
				);
		}

		return $result;
	}

	public function connect_whmcs_api($postfields) {
		$url = Config::get('app.whmcs_api_url'); # URL to WHMCS API file goes here
		$username = Config::get('app.whmcs_api_username'); # Admin username goes here
		$password = Config::get('app.whmcs_api_password'); # Admin password goes here

		$postfields["username"] = $username;
		$postfields["password"] = md5($password);
		$postfields["responsetype"] = "json";

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_TIMEOUT, 100);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		$data = curl_exec($ch);
		curl_close($ch);

		return json_decode($data); # Decode JSON String
	}

	public function mcrypt_encrypt($plain_key, $plain_text) {

            $key = pack('H*', $plain_key);

            $key_size =  strlen($key);
            


            # create a random IV to use with CBC encoding
            $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
            $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
            
            # creates a cipher text compatible with AES (Rijndael block size = 128)
            # to keep the text confidential 
            # only suitable for encoded input that never ends with value 00h
            # (because of default zero padding)
            $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,
                                         $plain_text, MCRYPT_MODE_CBC, $iv);

            # prepend the IV for it to be available for decryption
            $ciphertext = $iv . $ciphertext;
            
            # encode the resulting cipher text so it can be represented by a string
            $ciphertext_base64 = base64_encode($ciphertext);

            return $ciphertext_base64;
	}

	private function create_plain_key($key) {
		$password = "password";
		$iterations = 1000;

		// Generate a random IV using mcrypt_create_iv(),
		// openssl_random_pseudo_bytes() or another suitable source of randomness
		$salt = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);

		$hash = hash_pbkdf2("sha256", $password, $salt, $iterations, 20);
	}

	
}