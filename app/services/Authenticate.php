<?php
use UserRepositoryInterface as UserInterface;


class Authenticate
{


    public function __construct(UserInterface $user_interface)
    {
        $this->user_interface = $user_interface; ///doign this only because couldn't get interface IOC to work; need to fix this to use proper DI
    }

    public static function is_logged_in()
    {
        return (Session::has('uid')) ? Session::get('uid') : false;
    }

    public static function get_uid()
    {
        return (Session::has('uid')) ? Session::get('uid') : -1;
    }

    public static function guest()
    {
        return !Authenticate::is_logged_in();
    }

    public static function member()
    {
        return self::is_logged_in();
    }

    public static function correct_user($uid)
    {
        $session_uid = Session::get('uid');
        return ($session_uid == $uid) ? true : false;
    }

    public static function correct_network($uid, $network_id)
    {
        $network = Network::where('user_id', '=', $uid)->where('id', '=', $network_id)->first();
        return ($network != null) ? true : false;
    }

    /***
     * Authenticate using user_hash
     * @param $user_hash
     * @return int|mixed|null
     */
    public static function correct_user_hash($user_hash)
    {
        $user_hash_obj = UserHash::where('user_hash', '=', $user_hash)->first();
        return ($user_hash_obj !== null) ? $user_hash_obj->user_id : null;
    }

    public static function store_login($uid)
    {
        $auth = App::make('Authenticate');
        $user = $auth->user_interface->find_user($uid);

        Session::put('uid', $uid);
        Session::put('firstname', $user->firstname);
        Session::put('lastname', $user->lastname);
        Session::put('email', $user->email);
    }

    public static function get_email_confirmation_redirect()
    {
        return (Cookie::has('email_confirmation_redirect')) ? Cookie::get('email_confirmation_redirect') : null;
    }

    public static function store_email_confirmation_redirect()
    {
        return Cookie::forever('email_confirmation_redirect', Config::get('app.whmcs_url'));
    }

    public static function end_session()
    {
        Session::flush();
    }

    public static function store_cookie($uid, $user_hash)
    {
        Cookie::make('uid', $uid, time() + 9999999999, '/', '.unotelly.com');
        Cookie::make('user_hash', $user_hash, time() + 9999999999, '/', '.unotelly.com');
    }

    public static function delete_cookies()
    {
        Cookie::make('uid', '', time() - 10, '/', '.unotelly.com');
        Cookie::make('user_hash', '', time() - 10, '/', '.unotelly.com');

        //also need to kill custom php cookies from reigsterProcess.php outside of Laravel
        setcookie("uid", '', time()-1000, "/", ".unotelly.com");
        setcookie("user_hash", '', time()-1000, "/", ".unotelly.com");

    }

    public static function check_cookie_login()
    {

        if (Cookie::has('uid')) {
            $uid = Cookie::get('uid');
        }
        elseif ( isset($_COOKIE["uid"]) ){
            $uid = $_COOKIE["uid"];
        }

        if (Cookie::has('user_hash')) {
            $user_hash = Cookie::get('user_hash');
        }
        elseif ( isset($_COOKIE["user_hash"]) ){
            $user_hash = $_COOKIE["user_hash"];
        }

        if ((Cookie::has('uid')) && (Cookie::has('user_hash'))) {
            $user = UserHash::where('user_hash', '=', $user_hash)
                            ->where('user_id', '=', $uid)->first();

            if ($user !== null) {
                Authenticate::store_login($uid);
            }
        }
        else if(  isset($_COOKIE["uid"]) && isset($_COOKIE["user_hash"]) ) {
            $user = UserHash::where('user_hash', '=', $user_hash)
                            ->where('user_id', '=', $uid)->first();

            if ($user !== null) {
                Authenticate::store_login($uid);
            }
        }
    }

    /* Custom Redirect Guest Function */
    /* Adds a layer on top of default Redirect::guest to allow named route redirects instead of paths */
    public static function custom_redirect_guest($route,  $parameters = array()) {
        $path =  route($route, $parameters);
        return Redirect::guest($path);
   }

   public static function is_user_confirmed($uid) {
        $user_interface = App::make('UserRepositoryInterface');
        $user_confirmed = $user_interface->is_user_confirmed($uid);
        if($user_confirmed === TRUE) {
            return TRUE;
        } else {
            return FALSE;   
        }
   }

}
