<?php
use UserRepositoryInterface as UserInterface;
use SubRepositoryInterface as SubInterface;
use SessionRepositoryInterface as SessionInterface;

class UserController extends BaseController
{

    public function __construct(
            UserInterface $user_interface, 
            SubInterface $sub_interface,
            SessionInterface $session_interface
        )
    {
        $this->user_interface = $user_interface;
        $this->sub_interface = $sub_interface;
        $this->session_interface = $session_interface;
    }

    public function index() {
        return Redirect::route('user_edit');
    }

    public function edit() {
        // Fetch UID from session
        $uid = Authenticate::get_uid();
        $user = $this->user_interface->find_user($uid);
        if (!$user) {
            $error_msg = 'Error fetching user. Plesae try again or contact support@unotelly.com .';
            Session::flash('error', $error_msg);
            return Redirect::route('home');
        }
        return View::make('frontend.user.edit_full_user')->with('user',$user);

    }

    public function create()
    {
        $messages = Session::get('messages');
        $channels = Channel::where('display', '=', '1')->get();
        return View::make('frontend.user.create', compact('channels', 'messages'));
    }

    public function store()
    {

        $firstname = Input::get('firstname');
        $email = trim(Input::get('email'));
        $password = Input::get('password');
        $ip = Request::getClientIp();

        $special_promo = Input::get('special_promo');

        //need some validation here
        $validate_record = new UserValidation;

        if ($validate_record->fails('unotelly_billing')) {
            return Redirect::route('user_create')
                ->withErrors($validate_record->errors)
                ->withInput();
        }

        $user = $this->user_interface->create_user($firstname, $email, $password);

        if ( ! $user  ) {
            $error_msg = 'Error creating user. Plesae try again or contact support@unotelly.com .';
            Session::flash('error', $error_msg);
            return Redirect::route('user_create')->withInput();

        }

        $uid = $user->id;

        /* initialize user with  these things
        a. Insert Default User Hash
        b. Insert Default Account Location - Pending
        c. Insert Trial
        d. Insert Default Network
        */

        if($special_promo == TRUE) {
            $user_init = $this->user_interface->new_user_init($ip, $uid, $email, 'trial_40');

        } else {
            $user_init = $this->user_interface->new_user_init($ip, $uid, $email);

        }

        $user_init = $this->user_interface->new_user_init($ip, $uid, $email);
        $user_hash = $this->user_interface->find_user_hash($uid);


        Authenticate::store_login($uid);
        Authenticate::store_cookie($uid, $user_hash);

        $mailService = new MailService('sign_up_welcome');
        $mailService->queue([
            'email' => $email,
            'firstname' => $firstname,
            'title' => 'Welcome to UnoTelly!'
        ]);

        // Redirecting to choose dynamo page
        return Redirect::route('choose_dynamo', ['uid' => $uid]);
    }

    public function redirect_index()
    {
        return Redirect::route('user_index', ['uid' => $this->uid]);
    }


    public function create_full_user()
    {
        return View::make('frontend.user.create_full_user');
    }

    public function store_full_user()
    {

        $firstname = Input::get('firstname');
        $lastname = Input::get('lastname');
        $email = trim(Input::get('email'));
        $password = Input::get('password');
        $address1 = Input::get('address1');
        $city = Input::get('city');
        $state = Input::get('state');
        $postcode = Input::get('postcode');
        $country = Input::get('country');
        $ip = Request::getClientIp();

        $validate_record = new FullUserValidation($this->user_interface);

        if ($validate_record->fails('unotelly_billing')) {
            return Redirect::route('create_full_user')
                ->withErrors($validate_record->errors)
                ->withInput();
        }

        $user = $this->user_interface->create_full_user(
            $firstname, 
            $lastname, 
            $email, 
            $password, 
            $city, 
            $state, 
            $postcode, 
            $country,
            $address1
        );

        if ( ! $user ) {
            $error_msg = 'Error creating user. Plesae try again or contact support@unotelly.com .';
            Session::flash('error', $error_msg);
            return Redirect::route('create_full_user')->withInput();
        }


        $billing_interface = App::make('BillingRepositoryInterface');

        try {
            $whmcs_login_result = $billing_interface->auth_whmcs($email, $password);

        } catch (Exception $e) {
           $message = 'We are so sorry! Something wrong while creating your account. Please try again.';

            Session::flash('danger', $message);
                return Redirect::route('create_full_user')
                ->withInput();           
        }

        $uid = $whmcs_login_result->userid;


        $user_init = $this->user_interface->new_user_init($ip, $uid, $email);
        $user_hash = $this->user_interface->find_user_hash($uid);


        Authenticate::store_login($uid);
        Authenticate::store_cookie($uid, $user_hash);

        $mailService = new MailService('sign_up_welcome');
        $mailService->queue([
            'email' => $email,
            'firstname' => $firstname,
            'title' => 'Welcome to UnoTelly!'
        ]);


        $redirect_path = $this->session_interface->redirect_session($uid, $whmcs_login_result->passwordhash);

        if( ! $redirect_path ) {
            return 'Failed to redirect. Please contact support@unotelly.com . ';
        }

        return Redirect::to($redirect_path);
    }

    public function update()
    {

        $uid = Authenticate::get_uid();
        $user = $this->user_interface->find_user($uid);
        if (  !$user ) {
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
        $validate_record::$rules['email'] .= ','.$uid; // Ignore the uid being processed right now when checking unique email
        
        // If a password is given, pass it through validation, else ignore
        if ($password || $new_password) {
            $validate_record::$rules['password'] = 'required|correct_password';
            $validate_record::$rules['new_password'] = 'required|min:5';
        }

        else {
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
            $email, 
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
            return View::make('frontend.user.edit_full_user')->with('user',$user);
        }

        else {
            $error_msg = 'Error updating user profile: Please try again or contact support@unotelly.com .';
            Session::flash('error', $error_msg);
            return View::make('frontend.user.edit_full_user')->with('user',$user);
        }

        // Optional: Create a new email template for updated profile
    }



}