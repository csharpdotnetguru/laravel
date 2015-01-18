<?php

use DynamoRepositoryInterface as DynamoInterface;
use UserRepositoryInterface as UserInterface;


class DynamoController extends BaseController
{
    
    public function __construct(DynamoInterface $dynamo_interface, UserInterface $user_interface )
    {
        $this->dynamo_interface = $dynamo_interface;
        $this->user_interface = $user_interface;
        $this->uid = Authenticate::get_uid();
    }

    public function index($uid)
    {

    }

    public function edit()
    {
        $title = "UnoTelly - Dynamo Setting: Choose your favourite streaming.";

        $settings = $this->dynamo_interface->viewData();
        return View::make('frontend.dynamo.edit')
            ->with('settings', $settings)
            ->with('member', Authenticate::member())
            ->with('uid', $this->uid)
            ->with('title', $title)
            ->with('change_setting','active');

    }

    public function update()
    {
        $form = $this->getInput();

        //user does not have javascript enabled
        //recieve channel updates as one big form
        //loop through and save each
        $success=TRUE;

        if(count($form)==0){
           Session::flash('error','Nothing to update');
            return Redirect::route("dynamo_index", ['uid' => $this->uid]);
        }

        foreach ($form as $channel => $country) {
           $success = $this->dynamo_interface->process_normal_update($this->uid, $channel, $country);
        }

        if(! $success) {
            $message="Dynamo Failed to update";
            Session::flash('success',$message);
            return Redirect::route("dynamo_index", ['uid' => $this->uid]);
        }
       
        $message="Dynamo Updated";
        Session::flash('success',$message);
        return Redirect::route("dynamo_index", ['uid' => $this->uid]);

    }

    public function updateAjax()
    {
        $send = true;
        $input = $this->getInput();


        //value is a unique number attached to each response
        //this can be used to differentiate response
        //code currently not used
        $server_code=uniqid();


        //there should only ever be one variable passed at a time
        //for each is used to get the key and the value
        //key is channel value is country

        foreach ($input as $channel => $country_id) {

            $message = $this->dynamo_interface->process_ajax($this->uid, $channel, $country_id, $server_code);

            if ($send == true){
                //ensures values are sent once.
                //2 response was coming back on the javascript end
                //this is more a precaution than something absolutely needed
                $send=false;
                return Response::json($message);
            }
        }
    }

}