<?php namespace FrontEnd\V2;

use BaseController;
use Input;
use View;
use Response;
use SubRepositoryInterface as SubInterface;
use Request;
use App;
use Session;
use Redirect;
use Config;

class RatelimitController extends BaseController {

	public function __construct(SubInterface $sub_interface)
    {
    	$this->sub_interface = $sub_interface;
    }

    

    public function show_cc_update_recaptcha() {

        $ip = trim(Input::get('ip'));
        $rate_limit_interface = App::make('RateLimitRepository');
        $result = $rate_limit_interface->show_recaptcha($ip, 2);

        $show_recaptcha = [
            'status' => 1,
            'data' => [
                'message' => 'Show recaptcha.'
            ]
        ];

        $no_recaptcha = [
            'status' => 0,
            'data' => [
                'message' => 'Don\'t show recaptcha'
            ]
        ];

        if ($result === TRUE) {
            return $show_recaptcha;
        }
        return $no_recaptcha;
    }

    public function solve_cc_update_recaptcha() {

        require_once(app_path().'/libs/recaptchalib.php');
        $privatekey = Config::get('app.recaptcha_private_key');

        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

        if (!$resp->is_valid) {
            $error_msg = "The reCAPTCHA wasn't entered correctly. Please try again.";
            Session::flash('danger', $error_msg);
            return Redirect::intended('/quickstart');
        } 

        $ip = $_SERVER['REMOTE_ADDR'];
        $rate_limit_interface = App::make('RateLimitRepository');
        $rate_limit_interface->reduce_cc_recaptcha($ip);
        return Redirect::to('https://www.unotelly.com/portal/clientarea.php?action=creditcard');

    }

    public function get_form_cc_update_recaptcha() {
        return View::make('v2.frontend.cc_update_recaptcha.cc_update_recaptcha');
    }


}