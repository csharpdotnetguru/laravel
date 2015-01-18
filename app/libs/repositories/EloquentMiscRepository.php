<?php

class EloquentMiscRepository implements MiscRepositoryInterface {

	// public function get_all_channels()
	// {
	// 	return Channel::where('display', '=', 1)->orderBy('name')->get();
	// }

	public function channel_count()
	{
		return SupportedChannel::where('display', '=', 1)->count();

	}

	public function get_all_reviews()
	{
		return Review::orderBy(DB::raw('RAND()'))->get();
	}

	public function get_all_devices() {
		return ListDevice::all();
	}

	public function get_all_channels() {
		return SupportedChannel::where('display', '=', 1)->orderBy('name')->get();
	}

	public function get_device_useful_tips_articles($device_code) {
		return ListDevice::find($device_code)->useful_tips_articles()->get();
	}

	public function get_device_supported_channels($device_code) {
		return ListDevice::find($device_code)->supported_channels()->get();
	}


	public function get_channel_useful_tips_articles($channel_code) {
		return SupportedChannel::find($channel_code)->useful_tips_articles()->get();
	}

	public function get_channel_supported_devices($channel_code) {
		return SupportedChannel::find($channel_code)->supported_devices()->get();
	}


	// public function get_device_objects() {
	// 	$devices = ListDevice::all();

	// 	$device_objects = [];

	//     foreach($devices as $device) {
	//         $device->useful_tips_articles = $this->get_device_useful_tips_articles($device->device_code);
	//         $device->supported_channels = $this->get_device_supported_channels($device->device_code);
	//         array_push($device_objects, $device);
	//     }

	//     return $device_objects;
	// }

	public function get_device_object($device_code) {
		$device = ListDevice::find($device_code);
	    $device->useful_tips_articles = $this->get_device_useful_tips_articles($device->device_code);
	    $device->supported_channels = $this->get_device_supported_channels($device->device_code);

	    return $device;
	}

	public function get_channel_object($channel_code) {
		$channel = SupportedChannel::find($channel_code);
	    $channel->useful_tips_articles = $this->get_channel_useful_tips_articles($channel_code);
	    $channel->supported_devices = $this->get_channel_supported_devices($channel_code);

	    return $channel;
	}

	public function get_announcements() {
		$announcements = Announcement::where('display', '=', 1)->get();
		if($announcements->first() === NULL) {
			return NULL;
		}
		return $announcements;
	}

	public function get_testimonials($limit=100) {
        // if sqlite, use random(), else use RAND()
        if (Config::get('database.connections.unotelly_portal.driver') === 'sqlite') {
            return UserTestimonial::limit($limit)->orderBy(DB::raw('random()'))->get();
        } else {
		    return UserTestimonial::limit($limit)->orderBy(DB::raw('RAND()'))->get();
        }
	}
}