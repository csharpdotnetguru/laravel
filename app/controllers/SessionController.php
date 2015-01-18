<?php
use UserRepositoryInterface as UserInterface;
use SessionRepositoryInterface as SessionInterface;
use RateLimitRepositoryInterface as RateLimitInterface;
use SubRepositoryInterface as SubInterface;


class SessionController extends BaseController
{

    public function __construct(UserInterface $user_interface, Sessioninterface $session_interface, RateLimitInterface $rate_limit_interface, SubRepositoryInterface $sub_interface)
    {
        $this->user_interface = $user_interface;
        $this->session_interface = $session_interface;
        $this->rate_limit_interface = $rate_limit_interface;
        $this->sub_interface = $sub_interface;
        $this->uri = Request::path();
        $this->ip = $_SERVER['REMOTE_ADDR'];

    }

    public function checkout_login()
    {
        $rate_limit_interface = App::make('RateLimitRepository');
        $show_recaptcha = $rate_limit_interface->login_fail_recaptcha();


        return View::make('frontend.session.checkout_login')
            ->withMember(Authenticate::member())
            ->withTitle('UnoTelly - Login')
            ->with('show_recaptcha', $show_recaptcha);
    }

    public function checkout_login_auth()
    {

        $rate_limit_interface = App::make('RateLimitRepository');

        $login_fail_recaptcha = $rate_limit_interface->login_fail_recaptcha();

        if($login_fail_recaptcha === TRUE) {
            $solve_recaptcha = $rate_limit_interface->solve_recaptcha();

            if ($solve_recaptcha === FALSE) {
                $error_msg = "The reCAPTCHA wasn't entered correctly. Please try again.";
                Session::flash('danger', $error_msg);
                return Redirect::route('checkout_login')
                    ->withInput();
            } 
        }


        $ip = Request::server('REMOTE_ADDR');

        $signin_option = Input::get('signin_option');
        $email = trim(Input::get('email'));
        if($signin_option == 'register') {

            if( $this->user_interface->find_user_by_email($email) !== NULL)
            {
                $message = 'You already have an account under ' . $email . ' Please login instead.';
                Session::flash('danger', $message);
                return Redirect::route('checkout_login')
                    ->withInput();

            }

            return Redirect::route('create_full_user')
            ->with('email', $email);
        }

        $unsalted_password = Input::get('password');
        $billing_interface = App::make('BillingRepositoryInterface');

        $whmcs_login_result = $billing_interface->auth_whmcs($email, $unsalted_password);

        if($whmcs_login_result === FALSE) {
            $message = 'Wrong Email and Password. Please try again';
            $this->rate_limit_interface->record_login_failure($this->ip, $email, $this->uri);
            $this->rate_limit_interface->api_login_failure_incr($ip, $email);

            Session::flash('danger', $message);
                return Redirect::route('checkout_login')
                ->withInput();               
        }



        $this->rate_limit_interface->api_login_faliure_clear($ip);

        $uid = $whmcs_login_result->userid;

        $user_hash = $this->user_interface->find_user_hash($uid);

        if ($user_hash !== null) {
            $user_hash = $user_hash->user_hash;
        }
        else {
            $this->user_interface->create_hash_if_not_set($uid);
            $user_hash = $this->user_interface->find_user_hash($uid)->user_hash;
        }

        // email confirm check
        if (!$user_confirmed = $this->user_interface->is_user_confirmed($uid)) {
            // storing cookie to remember to redirect to order page when confirming email
            $cookie = Authenticate::store_email_confirmation_redirect();
            Session::flash('danger', 'Please confirm your email before proceeding.');
            Session::flash('show_resend_confirmation_button', 'true');

            return Redirect::back()->withCookie($cookie)->withInput();
        }

        Authenticate::store_login($uid);
        Authenticate::store_cookie($uid, $user_hash);


        $redirect_path = $this->session_interface->redirect_session($uid, $whmcs_login_result->passwordhash);

        if( ! $redirect_path ) {
            return 'Failed to redirect. Please contact support@unotelly.com . ';
        }

        return Redirect::to($redirect_path);
    }

    public function authenticate()
    {
        $ip = Request::server('REMOTE_ADDR');

        $email = trim(Input::get('email'));
        $unsalted_password = Input::get('password');
        $path =

        /* Check Login */
        $user = $this->user_interface->auth($email, $unsalted_password);


        $rate_limit_interface = App::make('RateLimitRepository');

        $login_fail_recaptcha = $rate_limit_interface->login_fail_recaptcha();

        if($login_fail_recaptcha === TRUE) {
            $solve_recaptcha = $rate_limit_interface->solve_recaptcha();

            if ($solve_recaptcha === FALSE) {
                $error_msg = "The reCAPTCHA wasn't entered correctly. Please try again.";
                Session::flash('danger', $error_msg);
                return Redirect::route('session_login')
                    ->withInput();
            } 
        }

        if ($user === NULL) {
            $message = 'Wrong Email and Password. Please try again';
            $this->rate_limit_interface->api_login_failure_incr($ip, $email);
            $this->rate_limit_interface->record_login_failure($this->ip, $email, $this->uri);
            Session::flash('danger', $message);
                return Redirect::route('session_login')
                    ->withInput();        
        }

        $this->rate_limit_interface->api_login_faliure_clear($ip);

        $uid = $user->id;

        $user_hash = $this->user_interface->find_user_hash($uid);

        if ($user_hash !== null) {
            $user_hash = $user_hash->user_hash;
        } else {
            $this->user_interface->create_hash_if_not_set($uid);
            $user_hash = $this->user_interface->find_user_hash($uid)->user_hash;
        }


        Authenticate::store_login($uid);
        Authenticate::store_cookie($uid, $user_hash);



        return Redirect::intended('/quickstart');
    }

    public function logout()
    {
        $logInfo = Authenticate::get_uid() . ' has Logged out';
        LogService::user_log($logInfo);

        Authenticate::end_session();
        Authenticate::delete_cookies();

        return Redirect::route('session_login');
    }

}
