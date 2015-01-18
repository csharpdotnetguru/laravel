<?php
use UserRepositoryInterface as UserInterface;

class EloquentSessionRepository implements SessionRepositoryInterface
{

	public function __construct(UserInterface $user_interface)
	{
		$this->user_interface = $user_interface;
	}

	public function redirect_path($uid)
	{
		$session_code = $this->insert_session_code($uid);
		if (! $session_code ) {
			return FALSE;
		}

		$whmcs_path = Config::get('app.whmcs_url');
		return $redirect_url = $whmcs_path . "/custom/whmcs_session_setter.php?uid=$uid&session_code=$session_code->session_code";

		//return "Redirecting to $redirect_url/custom/set_whmcs_session.php?uid=$uid&session_code=$session_code";
	}


    public function generate_session_code()
    {
        $alpha = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $rand_digit = rand(0,99999);
        $rand_string = $alpha[rand(0,50)] . $alpha[rand(0,50)] . $alpha[rand(0,50)] . $alpha[rand(0,50)] . $alpha[rand(0,50)]. $rand_digit;
        return md5($rand_string);
    }

    public function insert_session_code($uid)
    {
        $session_code = $this->generate_session_code();
        $result = SessionCode::create(['session_code' => $session_code , 'uid' => $uid]);
        if(! $result) {
            throw new Exception('Failed to generate session code.');
        }
        return $result;
    }

    public function auth_session_code($uid, $input_session_code)
    {
        $session_code = SessionCode::where('session_code', '=', $input_session_code)->where('uid', '=', $uid)->first();
        if ($session_code === NULL) {
            throw new Exception('Failed to find session code in database');
        }
        $session_code_created_time = $session_code->created_at->timestamp;

        if( $this->has_expired($session_code_created_time) ) {
            return FALSE;
        }
        return $session_code;
    }

    public function has_expired($session_code_created_time)
    {
        $expiry_time_limit = 120;
        if ( ($session_code_created_time + $expiry_time_limit) <= time() ) {
            return TRUE;
        }
        return FALSE;
    }

    public function redirect_session($uid, $upw) {
        $billing_interface = app::make('BillingRepositoryInterface');
        $hash = urlencode($billing_interface->mcrypt_encrypt(Config::get('app.mcrypt_key'), $upw));
        $whmcs_path = Config::get('app.whmcs_url');

        return $whmcs_path . "/custom/session_login.php?uid=$uid&hash=$hash";
        
    }


}