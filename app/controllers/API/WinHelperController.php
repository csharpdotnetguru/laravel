<?php
namespace API;
use Input;
use BaseController;
use Response;
use NetworkRepositoryInterface as NetworkInterface;
use UserRepositoryInterface as UserInterface;
use SubRepositoryInterface as SubInterface;
use ApiLoginAttempt;
use App;


class WinHelperController extends BaseController {

	public function __construct(NetworkInterface $network_interface, UserInterface $user_interface, SubInterface $sub_interface)
	{
		$this->network_interface = $network_interface;
		$this->user_interface = $user_interface;
		$this->sub_interface = $sub_interface;
	}


	public function get_dns_servers()
	{

		$dns_server_interface = App::make('DnsServerRepositoryInterface');
		$all_dns_servers = $dns_server_interface->get_all();

		$dns_servers = [];
		foreach($all_dns_servers as $dns_server) {

			$server = [
				's_id' => (string) $dns_server->id,
				's_type' => ucfirst($dns_server->server_type),
				's_ip' => $dns_server->server_ip,
				's_name' => ucfirst($dns_server->server_city)
			];
			array_push($dns_servers, $server);
		}
		

		$data = [

			"s__list_version"=> "1.0.0.0",

			"dns_servers"=> $dns_servers

		];


		return Response::json(
			array(
				'status' => 1,
				'msg' => 'List of DNS servers',
				'data' => $data
			),
			200
		)->setCallBack(Input::get('callback'));
	}


	public function version_check()
	{

        $version_check = file_get_contents('http://assets.unotelly.com/downloads/apps/windows/unohelper-version-manifest.json');
        $j_version_check = json_decode($version_check);

		return Response::json(
			array(
				'status' => $j_version_check->status,
				'msg' => $j_version_check->msg,
				'data' => $j_version_check->data
			),
			200
		)->setCallBack(Input::get('callback'));
	}


	public function l_auth()
	{
		$email = Input::get('email');
		$password = Input::get('password');
		$attempt_obj = new ApiLoginAttempt;

		/*** Check login ***/
		if ( ( $user = $attempt_obj->login_attempt('localhost', $email, $password) ) === NULL )
		{
			return Response::json(
				array(
					'status' => 0,
					'msg' => 'Wrong e-mail or password'
				),
				200
			)->setCallBack(Input::get('callback'));
		}

		$uid = $user->uid;

		$date_created = $this->find_free_sub($uid)->regTime;


		return Response::json(
				array(
					'uid' => $uid,
					'email' => $email,
					'datecreated' => $date_created,
					'status' => 1,
					'msg' => 'Login successful.'
				),
				200
		)->setCallBack(Input::get('callback'));



	}

	public function l_find_uid_by_nid()
	{
		$nid = Input::get('nid');

        $network = $this->network_interface->find_network_by_nid($nid);

        if ($network) {
            $uid = $network->user_id;

            return Response::json(
                    array(
                        'uid' => $uid,
                        'status' => 1,
                        'msg' => 'Uid found.'
                    ),
                    200
            )->setCallBack(Input::get('callback'));
        }
	}

	public function l_update_ip()
	{
		$nid = Input::get('nid');
		$network_attrs['client_ip'] = Input::get('client_ip');

		$network = $this->network_interface->find_network_by_nid($nid);

        if ($network) {
    		$this->network_interface->update_network($network, $network_attrs);
		    return "IP updated";
        }
	}

	public function l_get_networks()
	{
		$encoded_uid = Input::get('encoded_uid');
		$uid = '' ;


		if($uid = $this->chk_datecreated($encoded_uid) === NULL)
		{
			return('user not found');
		}

		$uid = $this->chk_datecreated($encoded_uid);

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

	public function l_get_user()
	{
		$encoded_uid = Input::get('encoded_uid');
		$uid = '' ;

		if($uid = $this->chk_datecreated($encoded_uid) === NULL)
		{
			return('user not found');
		}

		$uid = $this->chk_datecreated($encoded_uid);
		$user = $this->user_interface->find_user($uid);
		$uid = $user->uid;
		$email = $user->email;
		echo $uid . ":" . $email;
	}

	public function l_find_network_by_nid()
	{
		$nid = Input::get('nid');
		$network = $this->network_interface->find_network_by_nid($nid);
        if ($network) {
            $client_ip = $network->client_ip;
            $ip_label = $network->ip_label;
    		echo "$nid" . ":" . "$client_ip" . ":" . "$ip_label" . ":" . "0";
        } else {
            echo "$nid" . ":Unknown:Unknown:0";
        }
	}

	/*
		encode uid with datecreated in tblclients

	*/


	private function decode_uid($encoded_uid)
	{
		$vals['date_created_mod'] = floor($encoded_uid/1000000);
		$vals['uid'] = $encoded_uid % 1000000;
		return $vals;
	}

	private function chk_datecreated($encoded_uid)
	{
		$decoded_uid_arr = $this->decode_uid($encoded_uid);
		$decoded_uid = $decoded_uid_arr['uid'];
		$date_created_mod = $decoded_uid_arr['date_created_mod'];
		//find datecreate from $decoded_id
//		$date_created_db = $this->sub_interface->find_free_sub_by_uid($decoded_uid)->regTime;
		// echo $date_created_db;
		// echo "<br />";
		// echo $date_created_mod;
		// echo "<br />";
		// echo $date_created_db % 1000 ;
		// echo "<br />";

//		if($date_created_mod == ($date_created_db % 1000))
//		{
//			return $decoded_uid;
//		}
//		else
//		{
			return NULL;
//		}
	}


	private function encode_nid($uid, $network_id)
	{
		// $uid = 316574;
		// $network_id = 781561;
		$encoded_nid = ($uid % 1000) * 1000000 + (int) $network_id;
		echo $encoded_nid;
	}


	private function find_free_sub($uid)
	{
//		return $free_sub = $this->sub_interface->find_free_sub_by_uid($uid);
	}


}