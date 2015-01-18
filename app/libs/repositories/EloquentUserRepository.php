<?php
use NetworkRepositoryInterface as NetworkInterface;
use SubRepositoryInterface as SubInterface;

class EloquentUserRepository implements UserRepositoryInterface {


    public function __construct(NetworkInterface $network_interface, SubInterface $sub_interface)
    {
        $this->network_interface = $network_interface;
        $this->sub_interface = $sub_interface;
    }

    public function uid_user_hash_auth($uid, $user_hash) {
        $result = UserHash::where('user_id', '=', $uid)->where('user_hash', '=', $user_hash)->get();
        if($result->first() === NULL) {
            return FALSE;
        }
        return TRUE;
    }

    public function find_user_networks($uid)
    {
        return $network = Network::where('user_id', '=', $uid)->get();
    }

    public function find_user_hash($uid)
    {
        return $user_hash = UserHash::where('user_id', '=', $uid)->first();
    }

    public function find_user_subs($uid)
    {
        return $user_sub = Sub::where('clientid', '=', $uid)->get();
    }

    public function find_user_free($uid)
    {
        return $user_free = Free::where('userid', '=', $uid)->first();
    }

    public function assemble_user($uid)
    {
        return $user_networks = $this->find_user_networks($uid);
        $user_hash = $this->find_user_hash($uid);

        return $merged_obj = (object)array_merge((array)$user_networks, (array)$user_hash);
    }

    public function find_user_by_hash($user_hash)
    {
        return $user = UserHash::where('user_hash', '=', $user_hash)->first();
    }

    public function find_user_by_uid_hash($uid, $user_hash)
    {
        return $user = UserHash::where('user_hash', '=', $user_hash)->where('user_id', '=', $uid)->first();
    }

    public function prepare_hash($uid, $email, $ip_address)
    {
        return $user_hash = md5($uid . $email . $ip_address);
    }

    public function insert_hash($uid, $user_hash)
    {
        return $user_hash = UserHash::create(
            array(
                'user_id' => $uid,
                'user_hash' => $user_hash,
                'api_calls' => 0
            )
        );
    }

    public function create_hash_if_not_set($uid)
    {
        if ( $this->find_user_hash($uid) === NULL )
        {
            $user = $this->find_user($uid);
            $email = $user->email;
            if( ($network = $this->find_user_networks($uid)->first()) !== NULL)
            {
                $ip_address = $network->client_ip;
            }
            else
            {
                $ip_address = '1.1.1.1';
            }

            $user_hash = $this->prepare_hash($uid, $email, $ip_address);
            return $result = $this->insert_hash($uid, $user_hash);
        }
    }

    public function find_user($uid)
    {
        $user = User::where('id', '=', $uid)->get()->first();

        if ($user === null) {
            throw new Exception('User not found');
        }

        return $user;
    }


    public function create_user($firstname, $email, $password)
    {
        $encrypted_pw = $this->createPassword($password);

        $data = [
            'firstname' => $firstname,
            'email' => $email,
            'password' => $encrypted_pw,
            'lastname' => 'na',
            'address1' => 'na',
            'city' => 'na',
            'state' => 'na',
            'country' => 'na',
            'postcode' => 'na',
            'phonenumber' => '123456789',
            'datecreated' => date('Y-m-d'),
            'confirmed' => 0

        ];

        $user = User::create($data);
        if($user === NULL) {
            return FALSE;
        }


        $postfields['whmcs_uid'] = ($user->id);
        $postfields['firstname'] = $firstname;
        $postfields['password'] = $encrypted_pw;
        $postfields['email'] = $email;

        $uno_user = $this->duplicate_uno_user($postfields);
        return $user;
    }

    public function duplicate_uno_user($postfields) {
        $uno_user = UnoUserTmp::create($postfields);
        if($uno_user === NULL) {
            throw new Exception('Create duplicate user failed');
        }       
    }

    public function create_full_user(
        $firstname,
        $lastname,
        $email,
        $password,
        $city,
        $state,
        $postcode,
        $country,
        $address1
        )
    {
        $data = [
            'firstname' => $firstname,
            'email' => $email,
            'password' => $this->createPassword($password),
            'lastname' => $lastname,
            'address1' => $address1,
            'city' => $city,
            'state' => $state,
            'country' => $country,
            'postcode' => $postcode,
            'phonenumber' => '123456789',
            'datecreated' => date('Y-m-d'),
            'confirmed' => 0
        ];

        $user = User::create($data);

        if($user === NULL) {
            return FALSE;
        }
        return $user;
    }

    // Update User Profile
    public function update_full_user(
        $user,
        $firstname,
        $lastname,
        //$email,
        $city,
        $state,
        $postcode,
        $country,
        $address1,
        $password
        )
    {


        $user->firstname = $firstname;
        $user->lastname = $lastname;
        // $user->email = $email;
        $user->city = $city;
        $user->state = $state;
        $user->postcode = $postcode;
        $user->country = $country;
        $user->address1 = $address1;
        if ($password) $user->password = $this->createPassword($password);

        if(!$user->save()) {
            return FALSE;
        }
        return TRUE;
    }




         /******* New User initialization *********/

    /*
    1. Create new user in tblclients using billing api
        a. Insert Default Network
        b. Insert Default User Hash
        c. Insert Trial
        d. Insert Default Account Location - Pending

    */

    public function new_user_init($ip_address, $uid, $email, $pkg_uniq_id = 'trial_8')
    {
        //Create Default Network
        $network_attrs = [
                'client_ip' => $ip_address,
                'ip_label' => 'Default_Network',
                'ip_status' => 1
        ];

        $network = $this->network_interface->store($uid, $network_attrs);
        if( ! $network ) {
            throw new Exception("UID - $uid : Failed to create initial network. Please contact support@unotelly.com .");
        }

        //Create Default User Hash
        $user_hash = $this->prepare_hash($uid, $email, $ip_address);
        $user_hash_result = $this->insert_hash($uid, $user_hash);

        if(! $user_hash_result) {
            throw new Exception("UID - $uid : Failed to create initial user hash. Please contact support@unotelly.com .");
        }

        //Insert Default Trial
        $trial = $this->sub_interface->create_trial($uid, $pkg_uniq_id);

        return TRUE;
    }
















    /* Using local database ; No API */

    public function find_user_by_email($email)
    {
        $user = User::where('email', '=', $email)->get()->first();
        if ($user === NULL) {
            return NULL;
        }
        return $user;
    }





    public function generateSalt()
    {
        $letters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $i = 1;
        $salt = null;

        while ($i <= 5) {
            $pos = rand(0,strlen($letters)-1);
            $salt = $salt . $letters[$pos];
            $i++;
        }

        return $salt;
    }


    public function getSaltedPasswordFromDatabase($email)
    {
        $user = $this->find_user_by_email($email);
        if ($user === NULL) {
            return FALSE;
        }
        return $user->password;
    }


    public function extractSalt($salted_password)
    {
        return substr($salted_password, strrpos($salted_password, ':') + 1);
    }


    public function encryptPassword($unsalted_password, $salt)
    {
        return md5($salt . $unsalted_password) . ":" . $salt;
    }



    public function createPassword($password)
    {
        $salt = $this->generateSalt();
        return $this->encryptPassword($password, $salt);
    }


    public function auth($email, $unsalted_password)
    {
        $user = $this->find_user_by_email($email);

        //this check is required so we make sure we have an object to fetch the salt from db.
        if ($user === null) {
            return null;
        } else {
            $stored_salted_password = $this->getSaltedPasswordFromDatabase($email);
            $salt = $this->extractSalt($stored_salted_password);
            $entered_salted_password = $this->encryptPassword($unsalted_password, $salt);

            if ($stored_salted_password == $entered_salted_password) {
                return $user;
            } else {
                return null;
            }
        }
    }


    public function find_pw_hash($uid)
    {
        $pw_hash = User::where('id', '=', $uid)->get()->first();
        if($pw_hash === NULL) {
            throw new Exception("$uid: Failed to find pw hash.");
        }
        return $pw_hash->password;
    }

    public function obfusticate_email($email) {

        $length = strlen($email);

        $num_char_to_replace = (int) ($length * 0.5);

        for($i=0; $i<$num_char_to_replace-1; $i++) {
            $email[rand(0,$length-1)] = '*';
        }

        return $email;

    }

    public function find_user_by_uid($uid) {
        return User::find($uid);
    }

    public function find_users_by_ip($ip) {
        $network_interface = App::make('NetworkRepositoryInterface');
        $uids = $network_interface->find_uids_by_ip($ip);
        if($uids === FALSE) {
            return NULL;
        }
        $users = [];
        foreach($uids as $uid) {
            $user = $this->find_user_by_uid($uid);
            if($user !== NULL) {
                array_push($users, $user);
            }
        }
        return $users;
    }

    public function insert_update_cc($uid, $ip) {
        $data = [
            'uid' => $uid,
            'ip' => $ip
        ];
        return UpdateCc::create($data);
    }

    public function insert_recaptcha_update_cc($uid, $ip) {
        $data = [
            'uid' => $uid,
            'ip' => $ip
        ];
        return UpdateCcRecaptcha::create($data);
    }


    public function is_user_confirmed($uid) {
        $confirm_status = User::where('confirmed', '=', 1)->where('id', '=', $uid)->get()->first();
        if($confirm_status === NULL) {
            return FALSE;
        }
        return TRUE;
    }

    public function set_user_confirmed($uid, $key) {
        $user = User::where('id', '=', $uid)->get()->first();
        $user->confirmed = 1;
        $user->save();

        $uno_user = UnoUserTmp::where('whmcs_uid', '=', $uid)->get()->first();
        $uno_user->confirmed = 1;
        $uno_user->save();


        $sub_interface = App::make('SubRepositoryInterface');
        // remove key from redis
        $this->sub_interface->delete_confirmation_key($key);
    }

    public function incre_confirm_sent_count($uid) {
        $num_confirm = User::where('id', '=', $uid)->get()->first();
        $num_confirm->num_confirm_sent += 1;
        $num_confirm->save();
    }
}