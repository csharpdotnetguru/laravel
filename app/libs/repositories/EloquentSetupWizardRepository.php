<?php 
 
use SetupWizardRepositoryInterface as SetupWizardInterface;
use Device as Device;

class EloquentSetupWizardRepository implements SetupWizardInterface {


/**
 * [Get user's get_device_code based on user agent]
 * @param  [type] $user_agent [input as user agent; pass in $_SERVER['HTTP_USER_AGENT']]
 * @return [type]             [return the get_device_code as predefined device code]
 */
	public function get_device_code($user_agent)
	{ 
		
		$device_code    =   "Unknown OS Platform";

	    $os_array       =   array(
	                            '/windows nt 6.3/i'     =>  'win_8',
	                            '/windows nt 6.2/i'     =>  'win_8',
	                            '/windows nt 6.1/i'     =>  'win_7',
	                            '/windows nt 6.0/i'     =>  'win_vista',
	                            '/windows nt 5.2/i'     =>  'win_xp',
	                            '/windows nt 5.1/i'     =>  'win_xp',
	                            '/windows xp/i'         =>  'win_xp',
	                            '/windows nt 5.0/i'     =>  'win_xp',
	                            '/windows me/i'         =>  'win_xp',
	                            '/win98/i'              =>  'win_xp',
	                            '/win95/i'              =>  'win_xp',
	                            '/win16/i'              =>  'win_xp',
	                            '/macintosh|mac os x/i' =>  'mac_osx',
	                            '/mac_powerpc/i'        =>  'mac_osx',
	                            '/linux/i'              =>  'linux',
	                            '/Ubuntu/i'             =>  'linux',
	                            '/iphone/i'             =>  'iphone',
	                            '/ipod/i'               =>  'itouch',
	                            '/ipad/i'               =>  'ipad',
	                            '/android/i'            =>  'android',
	                            // '/blackberry/i'         =>  'BlackBerry',
	                            // '/webos/i'              =>  'Mobile'
	                        );

	    foreach ($os_array as $regex => $value) { 

	        if (preg_match($regex, $user_agent)) {
	            $device_code    =   $value;
	        }
	    }   
	    
	    return $device_code;
	}

/**
 * [Get the type of the device based on the os platform]
 * @param  [string] $os_platform [This is the unique device type code]
 * @return [string]              [Returns device type]
 */
	public function get_device_type($os_platform)
	{
		$pc = ['win_xp', 'win_vista', 'win_7', 'win_8', 'mac_osx', 'linux'];

		if( in_array($os_platform,$pc) ) {
			return $device_type = 'pc';
		}

		if($os_platform == 'ios' || $os_platform == 'android') {
			return $device_type = 'mobile';
		}

		return $device_type = 'unknown';
	}

/**
 * [get_devices_data_by_code ]
 * @param  [string] $device_code [device code]
 * @return [array]              [a list of devices sharing the same device code]
 */
	public function get_devices_data_by_code($device_code) 
	{
		return ListDevice::where('device_code', '=', $device_code)->get()->first();
	}

/**
 * [get_devices_data_by_type ]
 * @param  [string] $device_type []
 * @return [array]              []
 */
	public function get_devices_data_by_type($device_type)
	{
		return Device::where('type', '=', $device_type)->get();
	}

	public function get_all_devices()
	{
		return Device::all();
	}

	/** 
	 * Get Setup Wizard device data
	 */
	public function get_setup_wizard_devices($user_agent)
	{
		$p_detected_device = $this->get_OS($user_agent);
		$result ='';
		$device_type = '';
		$devices = Device::all();
		$detected_device = array();
		
		if($p_detected_device != 'Unknown OS Platform')
		{	
			$device_type = 'pc';
			if($p_detected_device == 'ios' || $p_detected_device == 'android')
			{
				$device_type = 'mobile';
			}

			// --

			if(!empty($devices))
			{
				foreach($devices as $dval) {
					if($dval->device_code == $p_detected_device) {
						$detected_device = $dval;
					}
				}
			}
			
		} else {
			$device_type = 'unknown';
		}

		// --

		return array(
			'os' => $p_detected_device,
			'device_type' => $device_type,
			'devices' => $devices,
			'detected_device' => $detected_device
		);
	}

/**
 * [Check if a device has video instruction]
 * @param  [object]  $device_data []
 * @return Mixed      []
 */
	public function has_video_instruction($device_data) 
	{
		if ( empty($device_data->youtube_url) ) {
			return FALSE;
		}
		return $device_data->youtube_url;
	}



	public function get_device_by_device_code($device_code)
	{
		$device = ListDevice::where('device_code', '=', $device_code)->get()->first();
		if ($device === NULL) {
			return FALSE;
		}
		return $device;
	}


	/**
	 * get video instruction data
	 */
	public function get_video_instruction_data($id)
	{	
		return Device::find($id);
	}

	/**
	 * get text instruction data
	 */
	public function get_text_instruction_data($id)
	{
		include_once ('simple_html_dom.php');

		$device_link = Device::find($id);

		// Create DOM from URL
		$html = file_get_html($device_link->link);

		$result = $html->find('div[class=c-wrapper]');
		return @$result[0];
	}
	
}