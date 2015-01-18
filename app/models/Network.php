<?php

/**
 * An Eloquent Model: 'Network'
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $client_ip
 * @property boolean $ip_status
 * @property string $ip_label
 * @property integer $last_updated
 * @property \Carbon\Carbon $lastmodified
 * @property \Carbon\Carbon $updated_at
 * @property \Carbon\Carbon $created_at
 */
class Network extends Eloquent
{
    protected $table = "client_ip_list";
    protected $guarded = [];


    /*
    Relationship to user: one network can only belong to one user
                            one user can have many networks
     */
    
    public function user()
    {
        return $this->belongsTo('User');
    }

    public function split_ip($ip)
    {
        return $ip_splited = explode('.', $ip);
    }

    public function validate_ip($ip1, $ip2, $ip3, $ip4)
    {
        $ip_address = $this->assemble_ip($ip1, $ip2, $ip3, $ip4);
        return filter_var($ip_address, FILTER_VALIDATE_IP);
    }

    public function assemble_ip($ip1, $ip2, $ip3, $ip4)
    {
        return $ip_address = trim($ip1) . '.' . trim($ip2) . '.' . trim($ip3) . '.' . trim($ip4);
    }

    public function can_delete_network($uid, $network_id)
    {
        //user must have minimum of 1 active network
        $count = Network::whereraw('user_id = ? and ip_status = ?', [$uid, 1])->get()->count();
        LogService::debug_log('The amount of networks Available are '.$count);
        if ($count >= 1) {
            //check if the network we want to delete is equal the last network
            $last_network_id = Network::whereraw('user_id = ? and ip_status = ?', [$uid, 1])->first();
            if ($network_id != $last_network_id->id) {
                LogService::debug_log("There are networks available for delete");
                return true;
            } else {
                LogService::debug_log("There are no networks available for delete. There are only $count Networks");
                return false;
            }
        } else {
            LogService::debug_log("There are no networks available for delete");
            return false;
        }
    }

    public function toggle($network_id)
    {
        return DB::update('update client_ip_list set ip_status = !ip_status WHERE id = ?', [$network_id]);
    }

    public function chk_network_off($uid, $ip_status)
    {
        //check if max network has been reached
        //TODO delete some test code below
        if ($ip_status === 1) {
            LogService::debug_log('The ip_status is equal to 1');
        } else {
            LogService::debug_log('The ip_status is not equal to 1. The status is '.$ip_status);
        }

        $test=(int) "1";
        if($test===1){
            LogService::debug_log("php working just fine");
        }else{
            LogService::debug_log("guess php not working");
        }
        //TODO test code ends here
        if ($this->can_activate_ip($uid) === false AND $ip_status === 1) {
            //there is a problem that is happening here. IF editing network that is enabled it gets turned off
            LogService::debug_log('turning network off');
            // echo "turning network off";
            $this->network_off($uid);
        } else {
            LogService::debug_log('Network Not turned off');
        }
    }

    public function can_activate_ip($uid)
    {
        $limit = 1;
        $on = 1;
        //mock method to activate ip if IP limit is below current limit
        $count = Network::whereraw('user_id = ? and ip_status = ?', array($uid, $on))->get()->count();
        if ($count < $limit) {
            LogService::debug_log("can add another ip");
            return true;
        } else {
            LogService::debug_log("cannot add another ip");
            return false;
        }
    }

    public function can_activate_network($uid)
    {

    }

    public function find_ip_limit($uid)
    {
        $paid_sub = PaidUser::where('clientid', '=', $uid)->get()->first();
        if($paid_sub === null) {
            return null;
        }
        $package_id = $paid_sub->package_id;
        $package = Package::where('id', '=', $package_id)->get()->first();
        if($package === null) {
            return null;
        }
        return $package->ip_limit;
    }

    /*
    Create
        1. max network
            a. empty ip_status
            b. active ip_status
        2. available network
            a. empty ip_status
            b. active ip_status


    */

    public function network_off($uid)
    {
        $networks = Network::where('user_id', '=', $uid)->where('ip_status', '=', 1)->first();
        // $networks = $networks->sortBy(function($network)
        // {
        // 	return $network->id;
        // });update
        $network = Network::find($networks->id);
        $network->ip_status = 0;
        $network->save();
        LogService::debug_log('Networked now turned off');
        LogService::debug_log('But lets double check');
        LogService::debug_log('Value is ' . Network::find($networks->id)->first()->ip_status);
        Log::info('network->network_off($uid): setting IP_status to 0 for the oldest record sorted by network id.');
    }


    public function find_first_active_network($uid)
    {
        $network = Network::where('user_id', '=', $uid)->where('ip_status', '=', 1)->first();
        if( is_null($network) )
        {
            $network = new Network;
            //if there is no active network,  trying to find just one network to update.
            $network->error_msg = "user $uid has no active network.";
            $network = Network::where('user_id', '=', $uid)->first();
            if ( is_null($network) )
            {
                $network = new Network;
                $network->error_array=[];
                $error= ['level'=>'300','code'=>'N','message'=>"User $uid does not contain a network\nUser must have atleast one network active"];
                $network->error_msg = "user $uid has no network.";
                $network->fatal_error = TRUE;
                //return $network;
            }

            //return $network;
           
        }
        return $network;
    }




}
