<?php namespace FrontEnd\V2;

use BaseController;
use Authenticate;
use Input;
use Request;
use UserValidation;
use MailService;
use Redirect;
use Response;
use View;
use EmailOptout;
use Session;

use UserRepositoryInterface as UserInterface;
use SubRepositoryInterface as SubInterface;
use SessionRepositoryInterface as SessionInterface;

class EmailOptoutController extends BaseController
{

    public function __construct(UserInterface $user_interface, SubInterface $sub_interface, SessionInterface $session_interface)
    {
        $this->user_interface = $user_interface;
        $this->sub_interface = $sub_interface;
        $this->session_interface = $session_interface;
    }

    public function get_email_optout_view()
    {
        $email_optout = Input::get('email_optout');
        return View::make('v2.frontend.email_optout.email_optout')
            ->with('email_optout', $email_optout);
    }

    public function post_email_optout()
    {
        $email = Input::get('email_optout');
        $ip = $_SERVER['REMOTE_ADDR'];
        $data = [
            'email' => $email,
            'ip' => $ip
        ];
        EmailOptout::create($data);
        $message = 'Email opted out.';
        Session::flash('success', $message);
        return Redirect::back();
    }

}