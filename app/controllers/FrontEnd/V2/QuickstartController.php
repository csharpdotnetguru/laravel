<?php namespace FrontEnd\V2;

use App;
use Authenticate;
use BaseController;
use Exception;
use Input;
use NetworkRepositoryInterface as NetworkInterface;
use Redirect;
use Session;
use UserRepositoryInterface as UserInterface;
use SubRepositoryInterface as SubInterface;
use View;
use Utils;

class QuickstartController extends BaseController
{

    public function __construct(UserInterface $user_interface, NetworkInterface $network_interface, SubInterface $sub_interface)
    {
        $this->user_interface = $user_interface;
        $this->network_interface = $network_interface;
        $this->sub_interface = $sub_interface;

        $this->uid = Authenticate::is_logged_in();
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

    public function index()
    {
        $users = $this->user_interface->find_users_by_ip($this->ip);

        $trial_days_left = null;

        $obfusticated_emails = [];

        if ($users !== NULL) {
            foreach ($users as $user) {
                if ($user !== NULL) {
                    array_push($obfusticated_emails, $this->user_interface->obfusticate_email($user->email));
                }
            }
            unset($user);
        }

        if (Authenticate::is_logged_in()) {
            $trial_days_left = $this->sub_interface->get_remaining_trial_days(Authenticate::get_uid());
            $user = $this->user_interface->find_user_by_uid($this->uid);
            $email_confirmed = ($this->sub_interface->check_if_email_is_confirmed($this->uid)) ? 'true' : 'false';
            if ($user === NULL) {
                throw new Exception('User Not Found');
            }
        } else {
            $email_confirmed = false;
            $user = [];
        }

        $view_name = 'index';
        $user_agent = Utils::parse_user_agent();

        // if consoles, serve text only version of quickstart
        if (in_array($user_agent['platform'], Utils::get_consoles())) {
            $view_name = 'text_only';
        }

        return View::make('v2.frontend.quickstart.' . $view_name)
            ->with('obfusticated_emails', $obfusticated_emails)
            ->with('user', $user)
            ->with('user_ip', $this->ip)
            ->with('email_confirmed', $email_confirmed)
            ->with('trial_days_left', $trial_days_left);
    }

    public function redirect_update()
    {

        $param = Input::get();

        if (isset($param['origin'])) {
            Session::put('new_ip_origin', $param['origin']);
            // var_dump(Session::all());
            // die();

            if ($this->uid === FALSE) {
                return Redirect::route('quickstart_index');
            }

            $this->network_interface->update_first_active_network($this->uid);

        } else {
            $param['origin'] = null;
        }

        return View::make('v2.frontend.quickstart.redirect_update')
            ->with('origin', $param['origin']);

    }

    public function get_troubleshoot()
    {
        $question_id = Input::get('question_id');

        //query db for question
        /*
            question_name
            answer ids

        */

        return View::make('v2.frontend.quickstart.error_modals.question_containers._question_container')
            ->with('question_id', $question_id);
    }
}