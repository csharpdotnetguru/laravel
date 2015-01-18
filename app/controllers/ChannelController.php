<?php

use MiscRepositoryInterface as MiscInterface;

class ChannelController extends BaseController {
	
	public function __construct(MiscInterface $misc_interface)
	{
		$this->misc_interface = $misc_interface;
	}

	public function index()
	{
		$channels = $this->misc_interface->get_all_channels();
		$channel_count = $this->misc_interface->channel_count();
		return View::make('frontend.channels.index')
			->with('channels', $channels);
	}

	public function channel_count()
	{
		$channel_count = $this->misc_interface->channel_count();
		return Response::json($channel_count);
	}
}