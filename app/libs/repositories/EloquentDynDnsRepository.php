<?php

use NetworkRepositoryInterface as NetworkInterface;

class EloquentDynDnsRepository implements DynDnsRepositoryInterface {


	public function __construct(NetworkInterface $network_interface)
	{
		$this->network_interface = $network_interface;
	}

	public function update_network_by_hostname($hostname, $ip_address)
	{
		$network = $this->find_active_network_by_hostname($hostname);
		if( $network === NULL )
		{
			return FALSE;
		}
		$network_attrs['client_ip'] = $ip_address;
		$this->network_interface->update_network($network, $network_attrs);
	}

	public function find_active_network_by_hostname($hostname)
	{
		$dyndns = $this->find_dyndns_by_hostname($hostname);
		if ( $dyndns === NULL )
		{
			return NULL;
		}
		// var_dump($dyndns);
		$uid = $dyndns->first()->uid;
		return $network = $this->network_interface->find_first_network($uid);
	}

	public function find_dyndns_by_hostname($hostname)
	{
		$dyndns = DynDns::where('hostname', '=', $hostname)->get();
		return count($dyndns) === 0 ? NULL : $dyndns; 
	}

	public function find_dyndns_by_uid($uid)
	{
		$dyndns = DynDns::where('uid', '=', $uid)->get();
		return count($dyndns) === 0 ? NULL : $dyndns; 
	}

	public function find_dyndns_by_id($dyndns_id)
	{
		return $dyndns = DynDns::find($dyndns_id);
	}

	public function update_dyndns($dyndns_id, $hostname)
	{
		$dyndns = $this->find_dyndns_by_id($dyndns_id);
		if($dyndns === NULL)
		{
			return FALSE;
		}
		$dyndns->hostname = $hostname;
		return $dyndns->save();
	}


	public function delete_dyndns($id)
	{
		$dyndns = DynDns::find($id);
		if($dyndns === NULL)
		{
			return false;
		}
		if( $dyndns->delete() === true)
		{
			return true;
		}
		return false;
	}

	public function create_dyndns($uid, $hostname)
	{
		return $dyndns = DynDns::create(
            array(
                'uid' => $uid,
                'hostname' => $hostname            
            )
        );
	}

	public function correct_dyndns_owner($uid, $dyndns_id)
	{
		$dyndns = DynDns::where('uid', '=', $uid)->where('id', '=', $dyndns_id)->first();
		if($dyndns === NULL)
		{
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
}