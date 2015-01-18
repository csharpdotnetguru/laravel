<?php

class EloquentNetworkRepository extends NetworkRepositoryInterface {


    public function __construct()
    {
    }

    public function find_networks_by_uid($uid)
    {
        return Network::where('user_id', '=', $uid)->get();
    }

    public function find_network_by_nid($nid)
    {
       return $network = Network::find($nid);
    }

    public function destroy_network($network_id)
    {
        return Network::destroy($network_id);
    }

    public function toggle_network_status($network_id)
    {
        return DB::update('update client_ip_list set ip_status = !ip_status WHERE id = ?', [$network_id]);
    }

    public function store($uid, $network_attrs)
    {
        return $network = Network::create(
            array(
                'user_id' => $uid,
                'client_ip' => $network_attrs['client_ip'],
                'ip_label' => $network_attrs['ip_label'],
                'ip_status' => $network_attrs['ip_status']
            )
        );
    }

    public function find_user_networks($uid)
    {
        return Network::where('user_id', $uid)->get();
    }

    public function find_first_network($uid)
    {
        $network = Network::where("user_id", $uid)->where('ip_status', 1)->first();
        if($network === NULL) {
            return $this->create_network_if_not_exist($uid);
        }
        return $network;
    }


    public function create_network_if_not_exist($uid)
    {
        $network_attrs = [
                'user_id' => $uid,
                'client_ip' => $_SERVER['REMOTE_ADDR'],
                'ip_label' => 'Created_when_null',
                'ip_status' => 1
        ];
        return $this->store($uid, $network_attrs);
    }

    public function update_network($network_obj, $network_attrs)
    {

        if( isset($network_attrs['ip_status']) )
        {
            $network_obj->ip_status = $network_attrs['ip_status'];
        }

        if ( isset($network_attrs['ip_label']) )
        {
            $network_obj->ip_label = $network_attrs['ip_label'];
        }

        if ( isset($network_attrs['client_ip']) )
        {
            $network_obj->client_ip = $network_attrs['client_ip'];
        }

        $network_obj->save();
        return $network_obj;
    }


/**
 * Find UID by IP address
 * @param  [string] $ip
 * @return [mixed]
 */
    public function find_uids_by_ip($ip)
    {
        $active_networks = Network::where('client_ip', '=', $ip)
        ->where('ip_status', '=', 1)
        ->get();

        if($active_networks->first() === NULL) {
            return FALSE;
        }

        $uids = [];

        foreach($active_networks as $active_network) {
            $user = User::find($active_network->user_id);

            // double checking is user still exists in tblclients
            if ($user)
                array_push($uids, $active_network->user_id);
        }

        return $uids;
    }


    public function is_known_user($ip) {
       $users = $this->find_uids_by_ip($ip);
       return $users !== FALSE  ? $users : FALSE;
    }

/**
 * [This is the API to update user's first active network by user hash]
 * @param  [type] $ip        [User Incoming SRC IP]
 * @param  [type] $uid [uid of that user]
 * @return [type]            [FALSE if update failed and Network object is updated is successful.]
 */
    public function update_network_by_uid($ip, $uid)
    {
        $network = $this->find_first_network($uid);
        $network->client_ip = $ip;
        $network->updated_at = null; //force save even if nothing has changed

        $result = $network->save();

        if( $result === FALSE ) {
            return FALSE;
        }
        return $network;
    }

}