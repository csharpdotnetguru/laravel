<?php 
namespace API;
use Input;
use BaseController;
use Response;
use Network;
use Authenticate;
use UserHash;
use Log;
use ApiNetworkValidation;
use NetworkRepositoryInterface as NetworkInterface;
use UserRepositoryInterface as UserInterface;

class NetworkController extends BaseController {

	public function __construct(NetworkInterface $network_interface, UserInterface $user_interface)
	{
		$this->network_interface = $network_interface;
		$this->user_interface = $user_interface;
	}

	/***

	Link to be called by cron to reset api per day 
	@params
		$reset_key
	return true/false
	***/

	public function find_uid_by_nid()
	{
		$nid = Input::get('nid');
		$passkey = 'k94lfg13';
		$incoming_passkey = Input::get('passkey');
		if ($incoming_passkey != $passkey)
		{
			return "Error";
		}
		$uid = $this->network_interface->find_network_by_nid($nid)->user_id;
		
		return Response::json(
				array(
					'uid' => $uid,
					'status' => 1,
					'msg' => 'Uid found.'
				), 
				200
		)->setCallBack(Input::get('callback')); 
	}


	/*
		encode uid with datecreated in tblclients
	
	*/

	private function encode_nid($uid, $network_id)
	{
		// $uid = 316574;
		// $network_id = 781561;
		$encoded_nid = ($uid % 1000) * 1000000 + (int) $network_id;
		echo $encoded_nid;
	}

	public function get_networks()
	{
		/* Need to implement rate limit */
		
		$user_hash = Input::get('user_hash');
		// die($user_hash);

		if ( ( $uid = Authenticate::correct_user_hash($user_hash) ) === NULL )
		{
			Log::info('API/NetworkController | update() | User hash is wrong: ' . $user_hash);
			return Response::json(
				array(
					'status' => 0,
					'msg' => 'missing or wrong user hash'
				),
				401
			)->setCallBack(Input::get('callback'));
		}
		else
		{
			$uid = Authenticate::correct_user_hash($user_hash);
			Log::info('API/NetworkController | get_networks() | User hash is correct: ' . $user_hash);
		}


		$all_networks = $this->network_interface->find_user_networks($uid);
		foreach($all_networks as $network)
		{
			$networks_arr[] = [
				'nid' => $network->id,
				'network_label' => $network->ip_label,
				'network_ip' => $network->client_ip,
				'network_status' => $network->ip_status,
				'updated_at' => $network->updated_at
			];
		}

		return Response::json(array(
	    	'status' => '1',
	    	'msg' => 'Fetched all networks.',
	    	'data' => $networks_arr
	    ), 200)->setCallBack(Input::get('callback'));

	}

	public function l_update_ip()
	{
		$passkey = 'k94lfg13';
		$incoming_passkey = Input::get('passkey');
		$nid = Input::get('nid');
		$network_attrs['client_ip'] = Input::get('client_ip');

		if( $incoming_passkey != $passkey )
		{
			return "401";
		}

		$network = $this->network_interface->find_network_by_nid($nid);
		$this->network_interface->update_network($network, $network_attrs);
		return "IP updated";
	}

	public function l_unohelper_get_networks() 
	{
		$params = Input::all();
		$user_hash = $params['user_hash'];
		$uid = '';


		/* Check if user hash is correct */

		if ( ( $uid = Authenticate::correct_user_hash($user_hash) ) === NULL )
		{
			Log::info('API/NetworkController | win_unohelper_get_networks() | User hash is wrong: ' . $user_hash);
			return Response::json(
				array(
					'status' => 0,
					'msg' => 'wrong user hash'
				),
				401
			)->setCallBack(Input::get('callback'));
		}
		else
		{
			$uid = Authenticate::correct_user_hash($user_hash);
			Log::info('API/NetworkController | win_unohelper_get_networks() | User hash is correct: ' . $user_hash);
		}

		$all_networks = $this->network_interface->find_user_networks($uid);

		foreach($all_networks as $one_network) {
			$network_label = $one_network->ip_label;
			$network_ip = $one_network->client_ip;
			$network_id = $one_network->id;
			$encoded_nid = $this->encode_nid($uid, $network_id);
			echo $encoded_nid . ":" . $network_ip . ":" . $network_label;
			echo ";";
		}
		
	}

	public function reset_api_calls()
	{
		$params = Input::all();
		$incoming_passkey = '';
		$passkey = "k94lfg13";
		$user_hash_obj = new UserHash;

		if ( ! isset($params['passkey']) ) 
		{
			return Response::json(
				array(
					'status' => 0,
					'msg' => 'Unauthorized'
				),
				401
			); 
		}

		$incoming_passkey = $params['passkey'];


		if( ! ($incoming_passkey == $passkey) )
		{
			return Response::json(
				array(
					'status' => 0,
					'msg' => 'Unauthorized'
				),
				401
			); 
		}

		$user_hash_obj->reset_api_calls();
		return Response::json(
				array(
					'status' => 1,
					'msg' => 'API Calls Reset'
				),
				200
		);


	}

	public function update()
	{
		/* declare variables */
		$params = Input::all();
		$uid = '';
		$user_hash = '';
		$network_id = '';
		$ip_address = '';
		$user_hash_obj = new UserHash;
		$network_obj = new Network;
		$api_limit = 1000; // 300 calls per day
		$validate_record = ''; //initialize validator
		$api_calls = '';

		/* check if user_hash are set */
		if ( ! isset($params['user_hash']) )
		{
			Log::info('API/NetworkController | update() | and params["user_hash"] is not set');
			return Response::json(
				array(
					'status' => 0,
					'msg' => 'missing user hash'
				),
				401
			)->setCallBack(Input::get('callback')); 
		}

		else 
		{ 
			$user_hash = $params['user_hash']; 
			Log::info('API/NetworkController | update() | params["uid"]: ' .  $uid . ' and params["user_hash"]: ' . $user_hash);
		}


		/* Check if user hash is correct */

		if ( ( $uid = Authenticate::correct_user_hash($user_hash) ) === NULL )
		{
			Log::info('API/NetworkController | update() | User hash is wrong: ' . $user_hash);
			return Response::json(
				array(
					'status' => 0,
					'msg' => 'wrong user hash'
				),
				401
			)->setCallBack(Input::get('callback'));
		}
		else
		{
			$uid = Authenticate::correct_user_hash($user_hash);
			Log::info('API/NetworkController | update() | User hash is correct: ' . $user_hash);
		}

		/* if network ID is not set, use the default active network id */

		if ( ! isset($params['network_id']) | empty($params['network_id']) )
		{
			$network_id = $this->network_interface->find_first_network($uid)->id;
			Log::info('API/NetworkController | update() | params["network_id"] is not set OR empty');
		}

		else 
		{
			$network_id = $params['network_id'];
			Log::info('API/NetworkController | update() | params["network_id"]: ' . $network_id);

		}
		
		/* if no ip address is passed in, use http to get user's ip */

		if( ! isset($params['ip_address']) | empty($params['ip_address']) )
		{
			Log::info('API/NetworkController | update() | params["ip_address"] is not set or empty.');
			$ip_address = $_SERVER['REMOTE_ADDR'];
		}

		else
		{
			$ip_address = trim($params['ip_address']);
			Log::info("API/NetworkController | update() | uid: $uid | params['ip_address']:  $ip_address");
		}



		/* Check if user has permission to update network */

		if ( Authenticate::correct_network($uid, $network_id) === FALSE )
		{
			Log::info('API/NetworkController | update() | User does not have permission to edit network: uid - ' . $uid . ' network_id - ' . $network_id);
			return Response::json(
				array(
					'status' => 0,
					'msg' => 'you don\'t have permission to edit this network'
				),
				401
			)->setCallBack(Input::get('callback'));
		}

		else
		{
			Log::info('API/NetworkController | update() | User has permission to edit network: uid - ' . $uid . ' network_id - ' . $network_id);

		}

		/* Validate enter Entered IP address format */
		$validate_record = new ApiNetworkValidation($params);
		if( $validate_record->fails() )
		{
			Log::info('API/NetworkController | update() | uid | ' . $uid . 'IP Address formati is invalid: ' . $ip_address);
			return Response::json(
				array(
					'status' => 0,
					'msg' => 'The IP address enetered is not valid.'
				),
				401
			)->setCallBack(Input::get('callback')); 
		}
		else
		{
			Log::info('API/NetworkController | update() | uid | ' . $uid . 'IP Address formati is valid: ' . $ip_address);
		}

		
		/* check if user is within api limit */
		if ( ( $user_hash_obj->is_over_api_limit($uid, $api_limit) ) ===  TRUE )
		{
			$api_calls = $user_hash_obj->num_api_calls($uid);
			Log::info('API/NetworkController | update() | User is over daily IP Update API limit: uid - ' . $uid . ' api_calls - ' . $api_calls . ' api_limit - ' . $api_limit);
			return Response::json(
				array(
					'status' => 0,
					'msg' => "You made $api_calls number of API calls. Exceeded API limit $api_limit"
				), 401
			)->setCallBack(Input::get('callback'));
		}

		else {
			$api_calls = $user_hash_obj->num_api_calls($uid);
			Log::info('API/NetworkController | update() | User can make IP Update API call: uid - ' . $uid . ' api_calls - ' . $api_calls . ' api_limit - ' . $api_limit);
		}

		//Everything is good. Proceed to update user's IP address
		$network = $network_obj->find($network_id);
		$network->client_ip = $ip_address;
		
		/* Increment API_calls by 1 */
			/* Need to decide whether to increment the call when save is successful or 
				increment whenever the API is called */
		$user_hash_obj->incre_api_calls($uid);


		$network->updated_at = null; //force save even if nothing has changed
		
		/* Attempt to save network model */
		if ( $network->save() )
		{
			Log::info('API/NetworkController | update() | User network updated: uid - ' . $uid . ' network_id - ' . $network_id . ' ip_address - ' . $ip_address);
			return Response::json(
				array(
					'user_id' => $network->user_id,
					'user_hash' => $user_hash,
					'network_id' => $network->id,
					'ip_address' => $network->client_ip,
					'api_calls' => $api_calls,
					'status' => 1,
					'msg' => 'IP updated'
				), 
				200
			)->setCallBack(Input::get('callback'));
		}
		
		else
		{
			Log::info('API/NetworkController | update() | User failed to save to model: uid - ' . $uid . ' network_id - ' . $network_id . ' ip_address - ' . $ip_address);			
		}
	}


	public function update_by_hash_api()
	{
		$user_hash = Input::get('user_hash');
		$ip = $_SERVER['REMOTE_ADDR'];
		$type = Input::get('type');

		$data = [
			'status' => false,
			'message' => '',
		];

		$user_hash_obj = $this->user_interface->find_user_by_hash($user_hash);

		if($user_hash_obj === NULL) {
			$data['message'] = 'Invalid User Hash.';
			return Response::json($data);
		}

		$uid = $user_hash_obj->user_id;

		$result = $this->network_interface->update_network_by_uid($ip, $uid);

		if($result === FALSE) {
			$data['message'] = 'Failed to update IP. Please contact support@unotelly.com';
			return Response::json($data);
		}
		

		$user_hash_obj->api_calls += 1;
		$user_hash_obj->save();

		$data = [
			'status' => true,
			'message' => 'IP Updated.',
			'data' =>	[
				'new_ip' => $result->client_ip,
				'api_calls' => $user_hash_obj->api_calls
			]
		];
		
		if($type == 'json') {
			return Response::json($data);
		}
		
		return "IP Updated!";
	}

}