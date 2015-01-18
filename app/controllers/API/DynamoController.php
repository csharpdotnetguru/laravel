<?php namespace API;

use BaseController;
use Input;
use View;
use Response;
use DynamoRepositoryInterface as DynamoInterface;
use UserRepositoryInterface as UserInterface;
use Request;


class DynamoController extends BaseController {

	public function __construct(DynamoInterface $dynamo, UserInterface $user_interface )
    {
        $this->dynamo = $dynamo;
        $this->user_interface = $user_interface;
    }

    public function index()
   	{
	    $channels_collect = $this->dynamo->assemble_channels();
	    return Response::json(array(
	    	'status' => '1',
	    	'data' => $channels_collect
	    ), 200)->setCallBack(Input::get('callback'));
   	}

   	public function dyn_prefs()
   	{
   		$params = Input::all();
   		$dyn_pref_collec = $this->dynamo->assemble_dyn_prefs($params['uid']);
   		return Response::json(array(
	    	'status' => '1',
	    	'data' => $dyn_pref_collec
	    ), 200)->setCallBack(Input::get('callback'));
   	}

   	/*
		@params
			uid
			channel_id
			country_id
   	*/
   	public function update()
   	{
   		$params = Input::all();
   		$dyn_pref = $this->dynamo->update_dyn_pref($params['uid'], $params['channel_id'], $params['country_id']);
   		return Response::json(array(
	    	'status' => '1',
	    	'msg' => 'Dynamo setting updated.'
	    ), 200)->setCallBack(Input::get('callback'));
   	}


    public function js_mobile_channels()
    {
      $channels_collect = $this->dynamo->assemble_channels();

      $list_channels = View::make('api.dynamo.list_channels')->with('channels_collect', $channels_collect)->render();
      return Response::json(array(
         'status' => '1',
         'version' => '1.0.0',
         'data' => $list_channels
      ), 200)->setCallBack(Input::get('callback'));
    }

    public function js_mobile_channels_options()
    {
      $params = Input::all();
      $user = $this->user_interface->find_user_by_hash($params['user_hash']);
      $channels_collect = $this->dynamo->assemble_channels();
      $dyn_pref_collec = $this->dynamo->assemble_dyn_prefs($user->user_id);


      $list_channels_options = View::make('api.dynamo.list_channels_options')
        ->with('channels_collect', $channels_collect)
        ->with('user', $user)
        ->with('dyn_pref_collec', $dyn_pref_collec)
        ->with('user_hash', $params['user_hash'])
        ->render();

// var_dump($list_channels_options);

      return Response::json(array(
         'status' => '1',
         'data' => $list_channels_options
      ), 200)->setCallBack(Input::get('callback'));
    }

}