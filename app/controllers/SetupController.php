<?php

use DynamoRepositoryInterface as DynamoInterface;

class SetupController extends BaseController{

    public function __construct(DynamoInterface $dynamo_interface){
        $this->dynamo_interface=$dynamo_interface;
    }

    public function choose_dyn($uid){
        
        $title = "Dynamo: Step 2";
        $settings=$this->dynamo_interface->viewData();

        return View::make("frontend.dynamo_init.set_dyn")
            ->with('settings', $settings)
            ->with('uid', $uid)
            ->with('title', $title)
            ->with("step2",true);
    }

    public function choose_sys(){
        $title = "Chooes Device: Almost there...";
        return View::make("frontend.dynamo_init.set_sys")
            ->with('title', $title);
    }
}