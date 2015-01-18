<?php

use NetworkRepositoryInterface as NetworkInterface;
use PackageRepositoryInterface as PackageInterface;

class EloquentSubRepository implements SubRepositoryInterface
{

    public function __construct(PackageInterface $package_interface, NetworkInterface $network_interface)
    {
        $this->package_interface = $package_interface;
        $this->network_interface = $network_interface;
    }

    /*
    @params
        $uid
    @return
        boolean
    */
    public function has_paid_sub($uid)
    {
        $paid_sub = PaidUser::where('clientid', '=', $uid)->get()->first();
        if ($paid_sub === null) {
            return false;
        } else {
            return true;
        }
    }

    /*
        calculate subscription time
    @params
        $sub_length
    @return
        integer
    */
    public function cal_new_sub_time($sub_length)
    {
        return $end_time = time() + $sub_length;
    }

    /*
        calculate old sub time
    @params
        $sub_length
        $uid
    @return
        integer
    */
    public function cal_old_sub_time($uid, $sub_length)
    {
        $paid_sub = PaidUser::where('clientid', '=', $uid)->get()->first();
        if ($paid_sub === null) {
            return null;
        }
        $sub_end_time = $paid_sub->endTime + $sub_length;
        return $sub_end_time;
    }

    /*
        insert paid sub
    @params
        $uid
        $sub_length
        $product_id
        $product_type
    @return
        boolean
    */
    public function insert_sub($uid, $sub_length, $product_id, $product_type)
    {
        $end_time = $this->cal_new_sub_time($sub_length);
        $sub_data = [
            'clientid' => $uid,
            'productid' => $product_id,
            'productType' => $product_type,
            'productLength' => $sub_length,
            'startTime' => time(),
            'endTime' => $end_time,
            'status' => 'active'
        ];

        return PaidUser::create($sub_data);
    }

    /*
    update subscription
    */
    public function extend_sub($uid, $sub_length, $product_id, $product_type)
    {
        $paid_sub = PaidUser::where('clientid', '=', $uid)->get()->first();
        $end_time = $this->cal_old_sub_time($uid, $sub_length);

        $paid_sub->productid = $product_id;
        $paid_sub->productType = $product_type;
        $paid_sub->productLength = $sub_length;
        $paid_sub->endTime = $end_time;

        return $paid_sub->save();
    }

    public function create_sub($uid, $sub_length, $product_id, $product_type)
    {
        if ($this->has_paid_sub($uid) === TRUE) {
            return $this->extend_sub($uid, $sub_length, $product_id, $product_type);
        }
        return $this->insert_sub($uid, $sub_length, $product_id, $product_type);
    }

    public function change_status($uid, $status)
    {
        $sub = PaidUser::where('clientid', '=', $uid)->get()->first();
        if ($sub === NULL) {
            throw new Exception("Sub by Uid: $uid does not exist");
        }
        $sub->status = $status;
        if (!$sub->save()) {
            return FALSE;
        }
        return TRUE;
    }

    ///New Location Module
    public function store_sub($uid, $pkg_uniq_id, $product_id)
    {
        $package = $this->package_interface->find_package_by_uniq_id($pkg_uniq_id);
        if ($package === NULL) {
            throw new Exception("Package $pkg_uniq_id does not exist");
        }

        $sub_length = $package->length;

        // removing 5 days from trial length until user confirms email
        $end_time = $this->cal_new_sub_time($sub_length) - (3600*24*5);

        //echo date('M/d/Y', $end_time);

        $sub_data = [
            'clientid' => $uid,
            'pkg_uniq_id' => $package->pkg_uniq_id,
            'productid' => $product_id,
            'productLength' => $sub_length,
            'startTime' => time(),
            'endTime' => $end_time,
            'status' => 'active'
        ];

        $sub = PaidUser::create($sub_data);
        if (!$sub) {
            throw new Exception("UID: $uid - Failed to create sub.");
        }
        return $sub;
    }

    public function extend_old_sub($uid, $pkg_uniq_id, $product_id)
    {
        $package = $this->package_interface->find_package_by_uniq_id($pkg_uniq_id);
        if ($package === NULL) {
            throw new Exception("Package $pkg_uniq_id does not exist"); //need to catch exception properly
        }

        $paid_sub = PaidUser::where('clientid', '=', $uid)->get()->first();
        if ($paid_sub === NULL) {
            throw new Exception("Sub by Uid: $uid does not exist"); //need to catch exception properly
        }

        $sub_length = $package->length;
        $end_time = $this->cal_new_sub_time($sub_length);

        //echo date('M/d/Y', $end_time);

        $paid_sub->productLength = $sub_length;
        $paid_sub->productid = $product_id;
        $paid_sub->pkg_uniq_id = $pkg_uniq_id;
        $paid_sub->endTime = $end_time;
        $paid_sub->status = 'active';

        if ($paid_sub->save()) {
            return $paid_sub->endTime;
        }
        return FALSE;
    }

    public function init_sub($uid, $pkg_uniq_id, $product_id)
    {
        if ($this->has_paid_sub($uid) === TRUE) {
            return $this->extend_old_sub($uid, $pkg_uniq_id, $product_id);
        }
        return $this->store_sub($uid, $pkg_uniq_id, $product_id);
    }

    public function find_free_sub_info_legacy($uid)
    {
        $sub = Free::where('userid', '=', $uid)->get()->first();
        if ($sub === NULL) {
            return NULL;
        }

        if ((int)$sub->status === 0) {
            $status = 'Inactive';
        } else {
            $status = 'Active';
        }

        $data = [
            'expiry_date' => date('F/j/Y', $sub->endTime),
            'status' => $status
        ];

        return $data;
    }

    public function find_paid_sub_info_legacy($uid)
    {
        $sub = PaidUser::where('clientid', '=', $uid)->get()->first();
        if ($sub === NULL) {
            return NULL;
        }

        $data = [
            'expiry_date' => date('F/j/Y', $sub->endTime),
            'status' => ucfirst($sub->status)
        ];

        return $data;
    }

    public function find_review_sub_info_legacy($uid)
    {
        $sub = ReviewUser::where('user_id', '=', $uid)->get()->first();
        if ($sub === NULL) {
            return NULL;
        }

        if ((int)$sub->status !== 1) {
            $status = "VIP Review Suspended";
        } else {
            $status = "VIP Review";
        }

        $data = [
            'expiry_date' => '',
            'status' => $status
        ];

        return $data;
    }

    public function find_sub_info_legacy($uid)
    {
        $review_info = $this->find_review_sub_info_legacy($uid);

        if ($review_info !== NULL) {
            return $review_info;
        }

        $paid_info = $this->find_paid_sub_info_legacy($uid);

        if ($paid_info !== NULL) {
            return $paid_info;
        }

        $free_info = $this->find_free_sub_info_legacy($uid);

        if ($free_info !== NULL) {
            return $free_info;
        }

        return NULL;
    }

    public function find_unovpn_expiry($email)
    {
        $unovpn = UnoVpnUser::where('username', '=', $email)->where('attribute', '=', 'Expiration')->get()->first();
        if ($unovpn === NULL) {
            return NULL;
        }
        return $unovpn->value;
    }

    public function find_unovpn_pw($email)
    {
        $unovpn = UnoVpnUser::where('username', '=', $email)->where('attribute', '=', 'Cleartext-Password')->get()->first();
        if ($unovpn === NULL) {
            return NULL;
        }
        return $unovpn->value;
    }

    public function extend_trial($uid)
    {
        $new_time = (int)time() + 3600 * 24 * 8;
        $sub = PaidUser::where('clientid', '=', $uid)->get()->first();

        if ($sub === NULL) {

            //see user is old trial using Free table
            $sub_old = Free::where('userid', '=', $uid)->get()->first();

            if ($sub_old === NULL) {
                throw new Exception('Cannot find trial sub.');
            }
            $sub_old->endTime = $new_time;
            return $sub_old->save();
        }

        $sub->endTime = $new_time;
        return $sub->save();
    }

    public function create_trial($uid, $pkg_uniq_id)
    {
        //Check if trial already exists
        //$pkg_uniq_id = 'trial_8';
        $product_id = 0;
        return $this->init_sub($uid, $pkg_uniq_id, $product_id);
    }

    /**
     * Find all subscriptions by an array of Uids
     * @param  [type] $uids [an array of UID ; usually uids belong to the same IP]
     * @return [type]       [an array of sub scription status per uid]
     */
    public function find_subs_by_uids($uids)
    {
        $subs = [];

        foreach ($uids as $uid) {
            $sub = PaidUser::where('clientid', '=', $uid)->get()->first();

            if ($sub !== NULL) {
                array_push($subs, $sub);
            }
        }

        return empty ($subs) ? FALSE : $subs;
    }

    /**
     * [Check if subscrption is expired]
     * @param  [type]  $endTime [expiry in unix time]
     * @return boolean          [TRUE if expired; FALSE if not expired]
     */
    public function is_expired($endTime)
    {
        if ($endTime > time()) {
            return FALSE;
        }
        return TRUE;
    }

    /**
     * [See if any one of the sub is not expired]
     * @param  [array] $subs [multiple subscriptions from paidUsers]
     * @return [boolean]       [TRUE if one of the sub is not expired; FALSE is all of the Sub is expired]
     */
    public function are_subs_expired($subs)
    {
        $expired = TRUE;

        foreach ($subs as $sub) {

            if ($this->is_expired($sub['endTime']) === FALSE) {
                $expired = FALSE;
            }
        }

        return $expired;
    }

    public function get_remaining_trial_days($uid)
    {
        $sub = PaidUser::where('clientid', '=', $uid)->get()->first();

        if ($sub === NULL) {
            return NULL;
        }



        // if trial
        if (strpos($sub->pkg_uniq_id, 'trial') !== false) {
            $remaining_time = $sub->endTime - time();

            if ($remaining_time < 0) {
                return 0;
            } else {
                return round($remaining_time / (3600 * 24));
            }
        }

        return null;
    }

    public function are_subs_suspended($subs)
    {
        $suspended = TRUE;

        foreach ($subs as $sub) {

            if ($sub['status'] == 'active') {
                $suspended = FALSE;
            }
        }

        return $suspended;
    }

    /**
     * [Assemble array of accoutn status]
     * @param  [type] $ip [description]
     * @return [type]     [an array containings user's account status based on incoming ip]
     */
    public function assemble_ajax_account_status($ip, $email_confirmed = true)
    {
        $data = [
            'known_user' => NULL, // TRUE | FALSE
            'no_sub' => NULL, // TRUE | FALSE
            'expired' => NULL, // TRUE | FALSE
            'sub_suspended' => NULL, // TRUE | FALSE
            'email_confirmed' => $email_confirmed // TRUE | FALSE
        ];

        $users = $this->network_interface->is_known_user($ip);

        //we dont know who the user ip based on IP
        if ($users === FALSE) {
            $data['known_user'] = FALSE;
            return $data;
        }

        $data['known_user'] = TRUE;

        //Check If Incoming IP has any subs
        $subs = $this->find_subs_by_uids($users);

        //user has no sub
        if ($subs === FALSE) {
            $data['no_sub'] = TRUE;
            return $data;
        }

        //Users have subs
        $data['no_sub'] = FALSE;

        //are subscriptions expired?
        $subs_expiry = $this->are_subs_expired($subs);

        //All subs expired
        if ($subs_expiry === TRUE) {
            $data['expired'] = TRUE;
            return $data;
        }

        //One of the sub is not expired
        $data['expired'] = FALSE;

        //Are subscriptions suspended?
        $subs_suspension = $this->are_subs_suspended($subs);

        if ($subs_suspension === TRUE) {
            $data['sub_suspended'] = FALSE; //7-4-2014 never show account suspension
            return $data;
        }

        //One of the subs is not suspended
        //
        $data['sub_suspended'] = FALSE;
        return $data;
    }

    public function assemble_ajax_account_status_legacy($ip)
    {
        $data = [
            'expiry_status' => 'inactive',
            'account_status' => 'inactive'
        ];

        $users = $this->network_interface->is_known_user($ip);

        //we dont know who the user ip based on IP
        if ($users === FALSE) {
            return $data;
        }

        //Check If Incoming IP has any subs
        $subs = $this->find_subs_by_uids($users);

        //user has no sub
        if ($subs === FALSE) {
            return $data;
        }

        //are subscriptions expired?
        $subs_expiry = $this->are_subs_expired($subs);

        //All subs expired
        if ($subs_expiry === TRUE) {
            return $data;
        }

        //One of the sub is not expired
        $data['expiry_status'] = 'active';

        //Are subscriptions suspended?
        $subs_suspension = $this->are_subs_suspended($subs);

        if ($subs_suspension === TRUE) {
            return $data;
        }

        //One of the subs is not suspended
        //
        $data['account_status'] = 'active';
        return $data;
    }

    public function generate_confirmation_key($uid)
    {
        $redis = RedisL4::connection();

        // generating hash (key)
        $key = sha1(Request::getClientIp() . $uid . time());

        // storing key in redis
        $redis->set('confirmation_keys:' . $key, $uid);

        return $key;
    }

    public function get_uid_from_confirmation_key($key) {
        $redis = RedisL4::connection();
        return $redis->get('confirmation_keys:' . $key);
    }

    public function check_confirmation_key($key)
    {
        $redis = RedisL4::connection();

        // get stored key (value = uid)
        $key_exists = $redis->exists('confirmation_keys:' . $key);

       
        if ($key_exists == 1) {
            return true;
        }

        return false;
    }

    public function add_five_days_to_trial($uid) {
        $sub = PaidUser::where('clientid', $uid)->firstOrFail();
        $sub->endTime = $sub->endTime + (3600 * 24 * 5);
        return $sub->save();
    }

    public function check_if_email_is_confirmed($current_uid)
    {
        $redis = RedisL4::connection();

        $keys = $redis->keys('confirmation_keys*');

        // looping keys, checking values (uid)
        foreach ($keys as $key) {
            $uid = $redis->get($key);

            // if right uid, delete existing key
            if ($uid == $current_uid) {
                // if key is still in there, unconfirmed
                return false;
            }
        }

        // else, confirmed
        return true;
    }

    public function delete_confirmation_key($key)
    {
        $redis = RedisL4::connection();

        // deleting stored key from redis
        $redis->del('confirmation_keys:' . $key);
    }

    public function delete_existing_confirmation_keys($current_uid)
    {
        $redis = RedisL4::connection();

        // getting all keys
        $keys = $redis->keys('confirmation_keys*');

        // looping keys, checking values (uid)
        foreach ($keys as $key) {
            $uid = $redis->get($key);

            // if right uid, delete existing key
            if ($uid == $current_uid) {
                $redis->del($key);
            }
        }
    }

    public function gen_confirmation_url($uid) {
            // generating new confirmation key
            $confirmation_key = $this->generate_confirmation_key($uid);

            // generate new confirmation URL
            $confirmation_url = URL::route('user_confirmation', ['confirmation_key' => $confirmation_key]);
            return $confirmation_url;
    }

}