<?php

abstract class NetworkRepositoryInterface {

    abstract public function destroy_network($network_id);

    abstract public function toggle_network_status($network_id);

    abstract public function store($uid, $network_attrs);

    abstract public function find_first_network($uid);

    abstract public function find_networks_by_uid($uid);

    abstract public function update_network($network_obj, $network_attrs);

    abstract public function find_user_networks($uid);

    abstract public function find_network_by_nid($nid);

    public function create_network($uid, $network_attrs = NULL)
    {
        if( ! isset($network_attrs['client_ip']) )
        {
            $network_attrs['client_ip'] = $this->detect_remote_ip();
        }

        if( ! isset($network_attrs['ip_label']) )
        {
            $network_attrs['ip_label'] = "Default";
        }

        if( ! isset($network_attrs['ip_status']) )
        {
            $network_attrs['ip_status'] = 1;
        }

        return $this->store($uid, $network_attrs);
    }

    public function update_first_active_network($uid)
    {
        $network_obj = $this->find_first_network($uid);

        if ($network_obj === null) {
            $this->create_network($uid);
            $network_obj = $this->find_first_network($uid);
            //throw new DefaultNetworkNotFoundException("User: $uid | Network Not Found");
        }

        $network_attrs['client_ip'] = $this->detect_remote_ip();

        return $this->update_network($network_obj, $network_attrs);
    }


    public function detect_remote_ip()
    {
        return $_SERVER['REMOTE_ADDR'];
    }


}
