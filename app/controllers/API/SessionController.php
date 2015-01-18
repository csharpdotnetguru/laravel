<?php namespace API;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;

use BaseController;
use Response;
use UserHash;
use ApiLoginAttempt;
use User;
use UserRepositoryInterface as UserInterface;
use SessionRepositoryInterface as SessionInterface;
use RateLimitRepositoryInterface as RateLimitInterface;

class SessionController extends BaseController {

	public function __construct(UserInterface $user_interface,
		SessionInterface $session_interface,
		RateLimitInterface $rate_limit_interface)
	{
		$this->user_interface = $user_interface;
		$this->session_interface = $session_interface;
		$this->rate_limit_interface = $rate_limit_interface;
		$this->rl_api_login_failure_limit = 5;
		$this->rl_api_login_failure_ttl = 60 * 15;
        $this->uri = Request::path();
        $this->ip = $_SERVER['REMOTE_ADDR'];

	}

	public function authenticate()
	{
		$params = Input::get();
		$ip = Request::server('REMOTE_ADDR');

		if ( ! isset($params['email']) || !  isset($params['password']) )
		{
			return Response::json(
				array(
					'status' => 0,
					'msg' => 'missing email or password'
				),
				200
			)->setCallBack(Input::get('callback'));
		}

		$email = $params['email'];
		$unsalted_password = $params['password'];


		$user_obj = $this->user_interface->auth($email, $unsalted_password);


		/*** Check login ***/
		if($user_obj === null) {

			$this->rate_limit_interface->api_login_failure_incr($ip, $email);
            $this->rate_limit_interface->record_login_failure($this->ip, $email, $this->uri);

			return Response::json(
				array(
					'status' => 0,
					'msg' => 'Wrong e-mail or password'
				),
				200
			)->setCallBack(Input::get('callback'));
		}

		// Login is good; clear any accumulated block
        $this->rate_limit_interface->api_login_faliure_clear($ip);

		$uid = $user_obj->id;
		$user_hash = $this->user_interface->find_user_hash($uid)->user_hash;

		return Response::json(
				array(
					'uid' => $uid,
					'user_hash' => $user_hash,
					'email' => $email,
					'status' => 1,
					'msg' => 'Login successful.'
				),
				200
		)->setCallBack(Input::get('callback'));

	}


	public function find_user_hash()
	{
		$uid = Input::get('uid');
		$user_hash = $this->user_interface->find_user_hash($uid);

		if( $user_hash === NULL ) {
            return Response::json(
                [
                    'status' => 0,
                    'data' => [
                        'message' => 'Failed to find user hash.'
                    ]
                ]
            );
        }

        $user_hash = $user_hash->user_hash;

        return Response::json(
                [
                    'status' => 1,
                    'data' => [
                    	'user_hash' => $user_hash,
                        'message' => 'Success.',

                    ]
                ]
        );
	}

	public function find_pw_hash()
	{
		$uid = Input::get('uid');
		$pw_hash = $this->user_interface->find_pw_hash($uid);

		if( $pw_hash === NULL ) {
            return Response::json(
                [
                    'status' => 0,
                    'data' => [
                        'msg' => 'Failed to find user hash.'
                    ]
                ]
            );
        }

        return Response::json(
                [
                    'status' => 1,
                    'data' => [
                    	'pw_hash' => $pw_hash,
                        'msg' => 'Password Hash Found.',

                    ]
                ]
        );
	}

	public function session_code_auth()
	{
		$uid = Input::get('uid');
		$session_code = Input::get('session_code');

		$session_code_auth = $this->session_interface->auth_session_code($uid, $session_code);

		if( $session_code_auth === FALSE ) {
            return Response::json(
                [
                    'status' => 0,
                    'data' => [
                        'msg' => 'Wrong or expired session code.'
                    ]
                ]
            );
        }

        return Response::json(
                [
                    'status' => 1,
                    'data' => [
                    	'uid' => $uid,
                        'msg' => 'Session code ok.',

                    ]
                ]
        );
	}
}