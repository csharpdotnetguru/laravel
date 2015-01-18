<?php

use DeviceRepositoryInterface as DeviceInterface;

class DeviceController extends BaseController {

    public function __construct(DeviceInterface $device)
    {
        $this->device = $device;
    }

    /**
     * Get all Record From list_devices
     */
    public function get_all() {
    	return $this->device->get_all();
    }
}