<?php
use EloquentUserRepository as UserRepository;

/**
 * An Eloquent Model: 'ApiLoginAttempt'
 *
 * @property integer $id
 * @property string $ip_address
 * @property integer $raw_attempts
 * @property integer $wrong_attempts
 * @property boolean $block
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class ApiLoginAttempt extends Eloquent {


	/*
	
		insert_raw_attempt()
		Insert login raw attempts into table regardless failure or successful to track how many time API is called.
		@params
			ip_address
			current_time
		Create a new record if it does not already exists
		Modify record if it does

	*/

	public function insert_initial_attempt($ip_address)
	{
		$this->ip_address = $ip_address;
		$this->raw_attempts += 1;
		$this->save();
	}

	public function incre_attempt($ip_address, $attempt_name)
	{
		/* Check if record exists */
		$attempt_obj = $this::where('ip_address', '=', $ip_address)->get()->first();
	
		if ( $attempt_obj === NULL )
		{
			/* create new record */
			$this->insert_initial_attempt($ip_address);
			return TRUE;
		}

		else 
		{
			/* update record */
			Log::info("Models/ApiLoginAttempt | incre_attempt() $attempt_name | ip_address = $ip_address | IP exists in database; updating old record.");

			/* Increase raw count by 1 */
			$attempt_obj->$attempt_name +=1 ;
			echo ($attempt_obj->attempt_name);

			if ( ($attempt_obj->save()) === FALSE )
			{
				throw new Exception("Error: failed to save() $attempt_name");
			}
	
			return TRUE;
			
		}
	}

	/* 
		Reset Raw Attempt at interval 
		@params
			ip_address
			raw_limit: seconds
	*/
	public function reset_attempt($ip_address, $attempt_name)
	{
		$attempt_obj = $this->where('ip_address', '=', $ip_address)->get()->first();
		if ( $attempt_obj === NULL )
		{
			return FALSE;
		}

		$attempt_obj->$attempt_name = 0;

		if( ! $attempt_obj->save() )
		{
			throw new Exception("Error: Failed to save() $attempt_name");
		}

		return TRUE;

	}

	public function login_attempt($ip_address, $email, $unsalted_password)
	{
		$user_interface = App::make('UserRepositoryInterface');
        $user = $user_interface->auth($email, $unsalted_password);
		if($user === NULL)
		{
			/* return 401 failed login */
			$this->incre_attempt($ip_address, 'wrong_attempts'); //increase wrong attempt
			return NULL;
		} 
		/*** If login succeed, reset wrong_attempts ***/
		$this->reset_attempt($ip_address, 'wrong_attempts');

		return $user;
	}

	public function is_blocked($ip_address)
	{
		$api_login_attempts_obj = $this->where('ip_address', '=', $ip_address)->get()->first();
		if ( $api_login_attempts_obj === NULL )
		{
			return FALSE;
		}
		
		if( $api_login_attempts_obj->block != 1 )
		{
			return FALSE;
		}

		return TRUE;
	}

	/* 
		@ ip_address
		@ block_status: 1 or 0
	*/
	public function toggle_ip_block($ip_address, $block_status)
	{
		$api_login_attempts_obj = $this->where('ip_address', '=', $ip_address)->get()->first();
		if ( $api_login_attempts_obj === NULL )
		{
			return FALSE;
		}

		$api_login_attempts_obj->block = $block_status;
		$api_login_attempts_obj->save();
		return TRUE;
	}

	public function block_decision($ip_address, $raw_limit, $wrong_limit)
	{

		$api_login_attempts_obj = $this->where('ip_address', '=', $ip_address)->get()->first();
		if ( $api_login_attempts_obj === NULL )
		{
			return FALSE;
		}

		$raw_attempts = $api_login_attempts_obj->raw_attempts;
		$wrong_attempts = $api_login_attempts_obj->wrong_attempts;

		if ( ($raw_attempts >= $raw_limit) || ($wrong_attempts >= $wrong_limit) )
		{
			if ( $this->toggle_ip_block($ip_address, 1) )
			{
				return TRUE;
			}
		}

		$this->toggle_ip_block($ip_address, 0);

		return FALSE;
	}

	public function reset_decision($ip_address, $raw_reset_interval, $wrong_reset_interval)
	{

		$attempt_obj = $this->where('ip_address', '=', $ip_address)->get()->first();

		if ( $attempt_obj === NULL )
		{
			return FALSE;
		}

		$last_updated_time = strtotime( $attempt_obj->updated_at );

		if ( ( $last_updated_time + $raw_reset_interval ) < time() )
		{ 
			$this->reset_attempt($ip_address, 'raw_attempts');
		}

		if ( ( $last_updated_time + $wrong_reset_interval ) < time() )
		{
			$this->reset_attempt($ip_address, 'wrong_attempts');			
		}

	}

}