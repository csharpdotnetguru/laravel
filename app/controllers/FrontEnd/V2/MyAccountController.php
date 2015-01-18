<?php namespace FrontEnd\V2;

use BaseController;
use View;
use Input;
use Session;
use Request;
use Authenticate;
use FullUserValidation;
use Redirect;

use UserRepositoryInterface as UserInterface;
use SubRepositoryInterface as SubInterface;

class MyAccountController extends BaseController
{

    public function __construct(UserInterface $user_interface, SubInterface $sub_interface)
    {

        $this->user_interface = $user_interface;
        $this->sub_interface = $sub_interface;
        $this->uid = Authenticate::is_logged_in();
        $this->ip = $_SERVER['REMOTE_ADDR'];
    }

    public function index()
    {
        $email = Session::get('email');
        $sub_info = $this->sub_interface->find_sub_info_legacy($this->uid);
        $unovpn_pw = $this->sub_interface->find_unovpn_pw($email);
        $unovpn_expiry = $this->sub_interface->find_unovpn_expiry($email);

        $uid = Authenticate::get_uid();
        $user = $this->user_interface->find_user($uid);

        $has_vpn = TRUE;

        if ($unovpn_expiry === NULL OR $unovpn_pw === NULL) {
            $has_vpn = FALSE;
        }

        if ($sub_info === NULL) {
            $expiry_date = 'N/A';
            $sub_status = 'N/A';
        } else {
            $expiry_date = $sub_info['expiry_date'];
            $sub_status = $sub_info['status'];
        }

        return View::make('v2.frontend.my_account.index')
            ->with('uid', $this->uid)
            ->with('email', $email)
            ->with('expiry_date', $expiry_date)
            ->with('sub_status', $sub_status)
            ->with('unovpn_pw', $unovpn_pw)
            ->with('unovpn_expiry', $unovpn_expiry)
            ->with('has_vpn', $has_vpn)
            ->with('user', $user);
    }

    public function edit()
    {
        // Fetch UID from session
        $uid = Authenticate::get_uid();
        $user = $this->user_interface->find_user($uid);
        if (!$user) {
            $error_msg = 'Error fetching user. Plesae try again or contact support@unotelly.com .';
            Session::flash('error', $error_msg);
            return Redirect::route('home');
        }
        return View::make('v2.frontend.my_account.edit')->with('user', $user);

    }

    public function update()
    {
        $uid = Authenticate::get_uid();
        $user = $this->user_interface->find_user($uid);
        if (!$user) {
            $error_msg = 'Error updating user. Plesae try again or contact support@unotelly.com .';
            Session::flash('error', $error_msg);
            return Redirect::back();
        }

        $firstname = Input::get('firstname');
        $lastname = Input::get('lastname');
        $email = trim(Input::get('email'));
        $password = Input::get('password'); // Old Password
        $new_password = Input::get('new_password'); // New Password
        $address1 = Input::get('address1');
        $city = Input::get('city');
        $state = Input::get('state');
        $postcode = Input::get('postcode');
        $country = Input::get('country');
        $ip = Request::getClientIp();

        $validate_record = new FullUserValidation($this->user_interface);
        $validate_record::$rules['email'] .= ',' . $uid; // Ignore the uid being processed right now when checking unique email

        // If a password is given, pass it through validation, else ignore
        if ($password || $new_password) {
            $validate_record::$rules['password'] = 'required|correct_password';
            $validate_record::$rules['new_password'] = 'required|min:5';
        } else {
            $validate_record::$rules['password'] = '';
            $new_password = null;
        }

        if ($validate_record->fails('unotelly_billing')) {
            return Redirect::Back()
                ->withErrors($validate_record->errors)
                ->withInput();
        }

        $userUpdated = $this->user_interface->update_full_user(
            $user,
            $firstname,
            $lastname,
            // $email,
            $city,
            $state,
            $postcode,
            $country,
            $address1,
            $new_password
        );

        if ($userUpdated) {
            $success_msg = 'User profile updated successfully';
            Session::flash('success', $success_msg);
            return View::make('v2.frontend.my_account.edit')->with('user', $user);
        } else {
            $error_msg = 'Error updating user profile: Please try again or contact support@unotelly.com .';
            Session::flash('error', $error_msg);
            return View::make('v2.frontend.my_account.edit')->with('user', $user);
        }
    }

}