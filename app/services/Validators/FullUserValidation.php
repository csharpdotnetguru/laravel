<?php
use UserRepositoryInterface as UserInterface;
class FullUserValidation extends Services\Validators\ValidatorBase{
    public static $rules=[
        'email'=>'required|email|unique:tblclients,email',
        'firstname'=>'required:2',
        'password'=>'required|min:5',
        'address1'=>'required',
        'city'=>'required',
        'state'=>'required',
        'country'=>'required',
        'postcode'=>'required',
        'lastname'=>'required'
    ];
    public static $message=[
        'correct_password' => "The current password you entered is not correct",
    ];

    public function __construct(UserInterface $user_interface) {
        parent::__construct();
        $this->user_interface = $user_interface;
        \Validator::extend('correct_password', 'FullUserValidation@correct_password');
    }

    /* Custom Validation Rule: correct_password
        Checks whether the provided password is the correct unsalted password for logged in user
    */
    public function correct_password($attribute, $value, $parameters=null) {
        $email = (Session::has('email')) ? Session::get('email') : -1;
        // Alternate: Create a new function Authenticate::get_email()
        $auth = $this->user_interface->auth($email, $value);
        return $auth;
    }
}