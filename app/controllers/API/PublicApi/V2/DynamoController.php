<?php namespace API\PublicApi\V2;

use BaseController;
use Input;
use View;
use Response;
use DynamoRepositoryInterface as DynamoInterface;
use UserRepositoryInterface as UserInterface;
use Request;
use RateLimitRepositoryInterface as RateLimitInterface;
use Log;

class DynamoController extends BaseController {

    public function __construct(DynamoInterface $dynamo_interface, UserInterface $user_interface, RateLimitInterface $rate_limit_interface)
    {
        $this->dynamo_interface = $dynamo_interface;
        $this->user_interface = $user_interface;
        $this->rate_limit_interface = $rate_limit_interface;
        $this->uri = Request::path();
        $this->ip = $_SERVER['REMOTE_ADDR'];

    }

    /* Public API */


    public function post_update_dynamo() {
        $uid_input = trim(Input::get('uid'));
        $input_dyn_channel_id = trim(Input::get('channel_id'));
        $input_dyn_country_id = trim(Input::get('country_id'));

        if(empty($input_dyn_channel_id) OR empty($input_dyn_country_id)) {
            $data = [
                'status' => 0,
                'message' => 'Missing Channel ID and/or Country ID.',
            ];
            return Response::json($data, 200)->setCallBack(Input::get('callback'));
        }


        $result = $this->dynamo_interface->update_dyn_pref($uid_input, $input_dyn_channel_id, $input_dyn_country_id);
        
        if($result === 'FALSE') {
            $error_id = uniqid();
            Log::error('Failed to update Dyn via API.', [
                'error_id' => $error_id,
                'uri' => Request::path(), 
                'uid' => $uid_input, 
                'channel_id' => $input_dyn_channel_id,
                'country_id' => $input_dyn_country_id
            ]);

            $data = [
                'status' => 0,
                'message' => 'Error ID: '.$error_id . ' Some random error happened. Please contact supprt@unotelly.com ',
            ];

            return Response::json($data, 200)->setCallBack(Input::get('callback'));
        }


        $data = [
            'status' => 1,
            'message' => 'Dynamo Setting Updated.'
        ];
 
        return Response::json($data, 200)->setCallBack(Input::get('callback'));


    }

    public function get_dynamo_channels() {
        $uid_input = trim(Input::get('uid'));

        $dynamo_data = $this->dynamo_interface->construct_dyn_channels_obj($uid_input);
        $data = [
            'status' => 1,
            'message' => 'Success. Returning a list of Dynamo Channels.',
            'data' => $dynamo_data
        ];
 
        return Response::json($data, 200)->setCallBack(Input::get('callback'));

    }

}