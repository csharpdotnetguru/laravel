<?php namespace FrontEnd\V2;

use BaseController;
use View;
use Authenticate;
use App;

class SessionController extends BaseController {

    public function signIn()
    {
    	$ip = $_SERVER['REMOTE_ADDR'];

        $rate_limit_interface = App::make('RateLimitRepository');
        $show_recaptcha = $rate_limit_interface->login_fail_recaptcha();

        return View::make('v2.frontend.session.sign_in')
            ->withMember(Authenticate::member())
            ->withTitle('UnoTelly - Login')
            ->with('show_recaptcha', $show_recaptcha);
    }

}