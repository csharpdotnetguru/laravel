<?php

class EloquentDeviceRepository implements DeviceRepositoryInterface {

	/**
	 * Get all Record From list_dns_servers
	 */
	public function get_all() {
		return Device::all();
	}

}