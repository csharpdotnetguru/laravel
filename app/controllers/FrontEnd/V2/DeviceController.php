<?php namespace FrontEnd\V2;

use BaseController;
use View;
use Input;
use App;

use MiscRepositoryInterface as MiscInterface;

class DeviceController extends BaseController 
{
	
	public function __construct(MiscInterface $misc_interface) {
		$this->misc_interface = $misc_interface;
        $this->ip = $_SERVER['REMOTE_ADDR'];

        /* --- */
        // NOTE: can remove this when development is done
        if (App::environment('development')) {
            // check if ip not ::1 (when local)
            if (($this->ip === '::1') || ($this->ip === '127.0.0.1')) {
                // passing a sample ip
                $this->ip = '173.194.43.105';
            }
        }
        /* --- */
	}

	public function index() {
		$all_devices = $this->misc_interface->get_all_devices();
		return View::make('v2.frontend.devices.index')
			->with('all_devices', $all_devices);
	}

	public function get_modal() {
		$device_code = Input::get('item_id');
		$device_object = $this->misc_interface->get_device_object($device_code);

		$dns_server_interface = App::make('DnsServerRepositoryInterface');
		$dns_servers = $dns_server_interface->get_nearest_servers($this->ip);

		return View::make('v2.frontend.devices.modal')
			->with('device_object', $device_object)
			->with('dns_servers', $dns_servers);	
	}

}