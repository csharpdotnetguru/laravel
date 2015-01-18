<?php namespace FrontEnd\V2;

use BaseController;
use View;
use Input;
use SetupWizardRepositoryInterface as SetupWizardInterface;
use MiscRepositoryInterface as MiscInterface;

class SetupWizardController extends BaseController {

    public function __construct(SetupWizardInterface $setup_wizard_interface, MiscInterface $misc_interface)
    {
        $this->setup_wizard_interface = $setup_wizard_interface;
        $this->misc_interface = $misc_interface;
    }

    public function get_setup_wizard_devices()
    {
        return View::make('frontend.setup_wizard.setup_wizard')
            ->with('device_data', $this->setup_wizard_interface->get_setup_wizard_devices());
    }


    /*
        Step 1 is to determine the device type to be setup on
     */
    public function step1()
    {
        //$user_agent = '/windows nt 6.3/i';
        $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $device_code = $this->setup_wizard_interface->get_device_code($user_agent);
        //var_dump($device_code);

        $device_type = $this->setup_wizard_interface->get_device_type($device_code);
        //var_dump($device_type);


        $device_data = $this->setup_wizard_interface->get_devices_data_by_code($device_code);
        //var_dump($device_data);


        if($device_type == 'pc') {
            return View::make('v2.frontend.setup_wizard.step1.pc')
                ->with('device_data', $device_data);
        }

        if($device_type == 'mobile') {
            return View::make('v2.frontend.setup_wizard.step1.mobile')
                ->with('detected_devices', $detected_devices)
                ->with('gaming_devices', $gaming_devices)
                ->with('router_devices', $router_devices)
                ->with('mobile_devices', $mobile_devices)
                ->with('home_devices', $home_devices)
                ->with('pc_devices', $pc_devices);
        } 

        return View::make('v2.frontend.setup_wizard.step1.other_devices');

    }

/*
    Step 2 is to choose video or text instruction then display the instruction.
 */
    public function step2()
    {

        //two different display; choice when video instruction is available
        //
        $device_code = Input::get('device_code');

        $device_object = $this->misc_interface->get_device_object($device_code);

        if($device_object === NULL) {
            return 'No Device Found by that ID';
        }

        $video_instruction = $this->setup_wizard_interface->has_video_instruction($device_object);

        if($video_instruction === FALSE) {
            return View::make('v2.frontend.setup_wizard.step2.text_instruction')
                ->with('device_object', $device_object);
        }

        return View::make('v2.frontend.setup_wizard.step2.hybrid_instruction')
            ->with('device_object', $device_object);

    }




    public function setup_wizard_step2($id, $instruction_type)
    {
        if($instruction_type != 'false')
        {
            /*Cookie::forever('setup_wizard', array(
                    'selected_device' => $id,
                    'is_video_or_text' => $instruction_type
                ));*/

            $data = '';
            if($instruction_type == 'video')
            {
                $data = $this->setup_wizard_interface->get_video_instruction_data($id);
            }
            else
            {
                $data = $this->setup_wizard_interface->get_text_instruction_data($id);
            }

            return View::make('frontend.setup_wizard.setup_wizard_step2')
            ->with('setup_wizard_step2_data',array(
                'instruction_type' => $instruction_type,
                'data' => $data
                ));
        }
        else
        {
            /*$cookie = Cookie::make('setup_wizard', array('selected_device' => $id), 60000);
            return Redirect::to('/instruction_type')->withCookie($cookie);*/
            return View::make('frontend.setup_wizard.setup_wizard_instruction')->with('device_id', $id);
        }
    }
}