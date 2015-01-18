<?php namespace FrontEnd\V2;

use App;
use Authenticate;
use Aws\CloudFront\Exception\Exception;
use BaseController;
use Config;
use Input;
use MailService;
use Redirect;
use Request;
use Response;
use Session;
use SessionRepositoryInterface as SessionInterface;
use SubRepositoryInterface as SubInterface;
use URL;
use UserRepositoryInterface as UserInterface;
use UserValidation;
use View;
use Log;

class UserController extends BaseController
{

    public function __construct(UserInterface $user_interface, SubInterface $sub_interface, SessionInterface $session_interface)
    {
        $this->user_interface = $user_interface;
        $this->sub_interface = $sub_interface;
        $this->session_interface = $session_interface;
    }

    public function createAccount()
    {
        $firstname = Input::get('firstname');
        $email = trim(Input::get('email'));
        $password = Input::get('password');
        $ip = Request::getClientIp();

        $rate_limit_interface = App::make('RateLimitRepository');
        $show_recaptcha = $rate_limit_interface->multiple_signups_same_ip();

        if ($show_recaptcha === TRUE) {
            require_once(app_path() . '/libs/recaptchalib.php');
            $privatekey = Config::get('app.recaptcha_private_key');

            $resp = recaptcha_check_answer($privatekey,
                $_SERVER["REMOTE_ADDR"],
                $_POST["recaptcha_challenge_field"],
                $_POST["recaptcha_response_field"]);

            if (!$resp->is_valid) {
                $error_msg = "The reCAPTCHA wasn't entered correctly. Please try again.";
                Session::flash('danger', $error_msg);
                return Redirect::intended('/quickstart')
                    ->withInput();
            }
        }

        //need some validation here
        $validate_record = new UserValidation;

        if ($validate_record->fails('unotelly_billing')) {
            return Redirect::back()
                ->withErrors($validate_record->errors)
                ->withInput();
        }

        $user = $this->user_interface->create_user($firstname, $email, $password);

        if (!$user) {
            $error_msg = 'Error creating user. Please try again or contact support@unotelly.com.';
            Session::flash('danger', $error_msg);
            return Redirect::back();
        }

        $uid = $user->id;

        /* initialize user with  these things
        a. Insert Default User Hash
        b. Insert Default Account Location - Pending
        c. Insert Trial
        d. Insert Default Network
        */

        // generate confirmation key
        $confirmation_key = $this->sub_interface->generate_confirmation_key($uid);

        // generate confirmation URL
        $confirmation_url = URL::route('user_confirmation', ['confirmation_key' => $confirmation_key]);


        $user_init = $this->user_interface->new_user_init($ip, $uid, $email);
        $user_hash = $this->user_interface->find_user_hash($uid);

        Authenticate::store_login($uid);
        Authenticate::store_cookie($uid, $user_hash);

        $mailService = new MailService('confirm_email');
        $mailService->queue([
            'email' => $user->email,
            'firstname' => $user->firstname,
            'title' => 'Confirm your UnoTelly account now',
            'confirmation_url' => $confirmation_url
        ]);


        $this->user_interface->incre_confirm_sent_count($uid);


        // Redirecting to device setup page
        return Redirect::route('all_devices');
    }

    public function confirm($key)
    {

        $uid = $this->sub_interface->get_uid_from_confirmation_key($key);

        // Check if user is already confirmed
        if($this->user_interface->is_user_confirmed($uid) === TRUE) {
            Session::flash('success', 'Your account has already been confirmed. Enjoy UnoTelly!');
            return Redirect::route('quickstart_index');
        }

        // checks confirmation key
        if ($this->sub_interface->check_confirmation_key($key)) {

            //set user confirmed in redis & mysql
            $this->user_interface->set_user_confirmed($uid, $key);

            // extend trial for 5 more days
            $this->sub_interface->add_five_days_to_trial($uid);


            $email = $this->user_interface->find_user($uid)->email;
            $firstname = $this->user_interface->find_user($uid)->firstname;

            Session::flash('success', 'Email confirmed successfully!');

            $mailService = new MailService('sign_up_welcome');
            $mailService->queue([
                'email' => $email,
                'firstname' => $firstname,
                'title' => 'Welcome to UnoTelly!',
            ]);


            // if user confirmed email after getting the "confirm your email before ordering" error
            if ($url = Authenticate::get_email_confirmation_redirect()) {
                return Redirect::away($url);
            }


        } else {
            Session::flash('danger', 'Wrong confirmation key. Please try again.');
        }

        return Redirect::route('quickstart_index');
    }

    public function resend_confirmation()
    {
        $uid = Authenticate::get_uid();

        $rate_limit_interface = App::make('RateLimitRepository');

        if($rate_limit_interface->can_send_confirm($uid) === FALSE) {
            $message = "Sorry, we cannot send any more confirmation 
            because we've sent you " . Config::get('app.max_num_confirm') . " confirmation e-mails. Please check your inbox.";
            Session::flash('danger', $message);
            return Redirect::intended('/quickstart');
        }


        $user_confirmed = $this->user_interface->is_user_confirmed($uid);
        if($user_confirmed === TRUE) {
            $message = 'Cannot send confirmation because your account has been confirmed.';
            Session::flash('danger', $message);
            return Redirect::intended('/quickstart');
        }

        try {
            $user = $this->user_interface->find_user($uid);

            // deleting existing keys, if any
            $this->sub_interface->delete_existing_confirmation_keys($uid);

            $confirmation_url = $this->sub_interface->gen_confirmation_url($uid);


            // if dev, send confirmation url & uid in response
            if (App::environment('development')) {
                $response['confirmation_url'] = $confirmation_url;
                $response['uid'] = $uid;
                Log::info($confirmation_url);
            }

            $mailService = new MailService('confirm_email');
            $mailService->queue([
                'email' => $user->email,
                'firstname' => $user->firstname,
                'title' => 'Confirm your UnoTelly account now',
                'confirmation_url' => $confirmation_url
            ]);

            $this->user_interface->incre_confirm_sent_count($uid);

            $message = 'E-mail confirmation sent. Please check your e-mail';
            Session::flash('success', $message);
            return Redirect::intended('/quickstart');

        } catch (Exception $e) {
            $message = 'Fail to send e-mail confirmation. Please try again.';
            Session::flash('danger', $message);
            return Redirect::intended('/quickstart');
        }


    }



    public function checkIfEmailIsDuplicated()
    {
        $success = true;
        $email = Input::get('email');

        if ($this->user_interface->find_user_by_email($email)) {
            $success = false;
        }

        return Response::json(['success' => $success]);
    }

    public function get_signup_view()
    {
        $rate_limit_interface = App::make('RateLimitRepository');
        $show_recaptcha = $rate_limit_interface->multiple_signups_same_ip();

        return View::make('v2.frontend.user.signup')
            ->with('show_recaptcha', $show_recaptcha);
    }

}
