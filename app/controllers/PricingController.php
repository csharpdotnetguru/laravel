<?php

use MiscRepositoryInterface as MiscInterface;

class PricingController extends BaseController {
	
	public function __construct(MiscInterface $misc_interface)
	{
		$this->misc_interface = $misc_interface;
	}

    public function index()
    {
        return View::make('frontend.pricing.index');
    }


}