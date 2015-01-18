<?php
use NetworkRepositoryInterface as NetworkInterface;

class NetworkController extends BaseController
{


    public function __construct(NetworkInterface $network_interface)
    {
        $this->network_interface = $network_interface;
    }




    //For debug only

    public function index()
    {
        $title = 'hello my friend';

        // Fetch User Id from session
        $uid = Authenticate::get_uid();

        $networks = $this->network_interface->find_networks_by_uid($uid);

        $ip_update_link = new UserHash;
        $ip_update_link = $ip_update_link->get_ip_update_link($uid);

        //$this->die_d($networks);
        return View::make('frontend.networks.index')
            ->with('networks', $networks)
            //->with('uid', $uid) No longer required
            ->with('ip_update_link', $ip_update_link)
            ->with('title','UnoTelly - Authorized Networks')
            ->with('authorized_network','active');
    }



    public function create()
    {
        // Removed UID parameter
        return View::make('frontend.networks.create');
    }

    public function store()
    {
        // Fetch User Id from session
        $uid = Authenticate::get_uid();

        $network = new Network;
        $params = Input::all();

        $params=$this->ip_trim_zero($params);


        foreach ($params as $key => $value) {
            $params[$key] = preg_replace('/\ /', '', $value);
            LogService::debug_log($params[$key]);
        }
        $validate_record = new NetworkValidation($params);

        if (!isset($params['ip_status'])) {
            $ip_status = 0;
        } else {
            $ip_status = (int)$params['ip_status'];
        }

        $message = "";
        if ($validate_record->fails()) {

        } else if (!$ip_address = $network->validate_ip($params['ip1'], $params['ip2'], $params['ip3'], $params['ip4'])) {
            $message .= "Invalid ip format used.<br> Eg: 192.168.1.1";
            Session::flash('error', $message);
        } else {
            LogService::debug_log('Validation was successful');
            $network->chk_network_off($uid, $ip_status);
            $network = new Network;
            $network->user_id = $uid;
            $network->client_ip = $ip_address;
            $network->ip_label = $params['network_name'];
            $network->ip_status = $ip_status;

            if ($network->save()) {
                $message = "New network $network->ip_label has been successfully created";
                Session::flash('success', $message);
                return Redirect::route('network_index');
            } else {
                $message = "Network $network->ip_label could not be added to the list";
                Log::error("NetworkController@store: $message");
                Session::flash('error', $message, ['uid' => $uid]);
                return Redirect::route('network_index');
            }
        }
        return Redirect::route('network_index')
            ->withErrors($validate_record->errors)
            ->withInput();
    }

    public function show($network_id)
    {
        // Removed UID Attribute
        return $network_id;
    }

    public function edit($network_id)
    {
        $network = new Network;
        $network = $network->find($network_id);

        if (!$network) {
            $message = "Network does not exist.";
            Session::flash('error', $message);
            return Redirect::route('network_index');
        }

        return View::make('frontend.networks.edit')
            ->with('network', $network)
            ->with('splited_ip', $network->split_ip($network->client_ip))
            ->with('title',"UnoTelly - Edit ".ucfirst($network->ip_label))
            ->with('authorized_network','active');
    }

    public function auto_update(){

        // Fetch User Id from session
        $uid = Authenticate::get_uid();

        $first_network = $this->network_interface->update_first_active_network($uid);
        $message = "Network $first_network->ip_label updated<br>";
        Session::flash('success', $message);
        if(Session::has('new_ip_origin')) {
            $origin = Session::get('new_ip_origin');
            return View::make('v2.frontend.quickstart.redirect_update')
                    ->with('origin', $origin);

        }
        return Redirect::route('network_index');
    }

    public function update($network_id){

        // Fetch User Id from session
        $uid = Authenticate::get_uid();

        $network = new Network;
        $params = Input::all();

        $params=$this->ip_trim_zero($params);

        //perform validation checks

        foreach ($params as $key => $value) {
            $params[$key] = preg_replace('/\ /', '', $value);
            LogService::debug_log($params[$key]);
        }
        $validate_record = new NetworkValidation($params);

        if ($validate_record->fails()) {
            return Redirect::route('network_edit', ['network_id' => $network_id])->withErrors($validate_record->errors);
        } else if (!$ip_address = $network->validate_ip($params['ip1'], $params['ip2'], $params['ip3'], $params['ip4'])) {
            $message = "Please use correct format<br>";
            Session::flash('error', $message);
            return Redirect::route('network_edit', ['network_id' => $network_id])->withErrors($validate_record->errors);
        } else {

            if (!isset($params['ip_status'])) {
                $ip_status = 0;
            } else {
                $ip_status = (int)$params['ip_status'];
            }

            $network = Network::find($network_id);
            $network->ip_label = $params['network_name'];
            $network->client_ip = $ip_address;
            if ($network->can_activate_ip($uid)) {
                $network->ip_status = $ip_status;
            }
            $network->save();
            $message = "Network $network->ip_label updated<br>";
            Session::flash('success', $message);
        }
        return Redirect::route('network_index');
    }

    public function destroy($network_id)
    {
        // Fetch User Id from session
        $uid = Authenticate::get_uid();
        $params = Input::all();
        $network = Network::find($params['network_id']);
        $name = $network->ip_label;
        if ($network->can_delete_network($uid, $network_id) == true) {
            if ($network->delete()) {
                $message = "Network $name has been delete";
                Session::flash('success', $message);
                return Redirect::route('network_index');
            } else {
                $message = 'Error deleting network';
                Log::error("NetworkController@destroy: $message");
                Session::flash('error', $message);
                echo $message;
            }
        } else {
            $message = "Cannot delete Network $name";
            Session::flash('error', $message);
            return Redirect::route('network_index');
        }


        // var_dump($params);
    }

    public function toggle($network_id)
    {

        // Fetch User Id from session
        $uid = Authenticate::get_uid();

        $network = new Network;
        $network_name = $network->find($network_id)->ip_label;
        $network->chk_network_off($uid, 1);
        $network->toggle($network_id);

        $message = '$network_name has been changed';
        return Redirect::route('network_index');
    }


    private function ip_trim_zero($params){

        //Leading zeros would not validate
        //issue has been updated

        $params["ip1"]=$this->octet_trim($params["ip1"]);
        $params["ip2"]=$this->octet_trim($params["ip2"]);
        $params["ip3"]=$this->octet_trim($params["ip3"]);
        $params["ip4"]=$this->octet_trim($params["ip4"]);
        return $params;
    }

    private function octet_trim($octet){
        if(strlen($octet)>1){
            $octet=ltrim($octet, '0');
        }
        return $octet;
    }
}
