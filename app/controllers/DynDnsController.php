<?php

use DynDnsRepositoryInterface as DynDnsInterface;

class DynDnsController extends BaseController {


	public function __construct(DynDnsInterface $dyndns_interface, DynDnsValidation $dyndns_validation)
	{
		$this->uid = Authenticate::is_logged_in();

		$this->dyndns_interface = $dyndns_interface;
		$this->dyndns_validation = $dyndns_validation;
	}

	public function index()
	{
		$uid = $this->uid;
		$dyndns = $this->dyndns_interface->find_dyndns_by_uid($uid);
		
		return View::make('frontend.dyndns.index')
			->with('dyndns', $dyndns)
			->with('dyn','active');
	}

    public function create()
    {
    	$uid = $this->uid;
        return View::make('frontend.dyndns.create')
            ->with('uid', $uid);
    }

	public function store()
	{
		$hostname = Input::get('hostname');
		$uid = $this->uid;
        $validate_record = $this->dyndns_validation;

		/* Need validation for correct FQDN */
        if ($validate_record->fails()) {
   //          $message = "Failed to add hostname.";
			// Session::flash('error', $message);
			return Redirect::Back()
            	->withErrors($validate_record->errors)
          		->withInput();
        }
        else {
        	$message = 'Hostname added.';
            Session::flash('success', $message);
			$result = $this->dyndns_interface->create_dyndns($uid, $hostname);
			return Redirect::route('dyndns_index');
        }


        
    }

	public function destroy($dyndns_id)
	{
		/* need to check ownership of dyndns before delete */
		$delete_result =$this->dyndns_interface->delete_dyndns($dyndns_id);

		if ($delete_result === false)
		{
			$message = "Cannot delete hostname.";
            Session::flash('error', $message);
		}
		else
		{
			$message = "Hostname deleted.";
            Session::flash('success', $message);
		}
 			return Redirect::route('dyndns_index');
	}

	public function edit($dyndns_id)
	{
		$uid = $this->uid;
		return View::make('frontend.dyndns.edit')
            ->with('uid', $uid)
            ->with('dyndns_id', $dyndns_id);
	}

	public function update($dyndns_id)
	{
		$uid = $this->uid;
		$hostname = Input::get('hostname');
		$validate_record = $this->dyndns_validation;

		/* Need validation for correct FQDN */
        if ($validate_record->fails()) {
            $message = "Invalid hostname format used.";
			Session::flash('error', $message);
      		return Redirect::back()
          		->withErrors($validate_record->errors)
          		->withInput();
        }

		$result = $this->dyndns_interface->update_dyndns($dyndns_id, $hostname);
		if($result === FALSE )
		{
			$message = 'Failed to update DynDNS.';
			Session::flash('error', $message);
			return Redirect::back();
		}
		else 
		{
			$message = 'Hostname edited.';
            Session::flash('success', $message);
			return Redirect::route('dyndns_index');
		}

	}


	/*
		DynDNS API
		Inputs:
			@ip_address
			@hostname
		validate IP_Address
		validate hostname
		search owner of hostname
		search first active network based on uid
		update network
	
	*/

	public function dyndns_update()
	{
		/* need to add rate limi */
		
		$hostname = Input::get('hostname');
		$ip_address = Input::get('ip_address');

		$result = $this->dyndns_interface->update_network_by_hostname($hostname, $ip_address);

		if ( $result === FALSE )
		{
			return Response::json(
				array(
					'status' => 0,
					'msg' => 'Failed to update IP.'
				), 
				200
			)->setCallBack(Input::get('callback')); 

		}

		return Response::json(
				array(
					'status' => 1,
					'msg' => 'IP Updated.'
				), 
				200
		)->setCallBack(Input::get('callback')); 
	}
}
