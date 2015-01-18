<?php namespace FrontEnd\V2;

use BaseController;
use View;
use Input;
use Session;
use Exception;
use App;
use UserRepositoryInterface as UserInterface;
use SubRepositoryInterface as SubInterface;

use Network;
use Authenticate;
use WorldCup2014;

class PromoController extends BaseController 
{

	public function __construct(
				UserInterface $user_interface,
		        SubInterface $sub_interface
		) {

		$this->user_interface = $user_interface;
        $this->sub_interface = $sub_interface;
		$this->uid = Authenticate::is_logged_in();
		$this->ip = $_SERVER['REMOTE_ADDR'];
	}

	public function wc2014() {
	

		$wc2014 = new WorldCup2014;
		$matches = $wc2014->assemble_matches(40);
		
		return View::make('v2.frontend.promo.wc2014')
			->withTitle('UnoTelly - Watch World Cup 2014 Free - VPN and SmartDNS')
			->with('matches', $matches);

	}

	public function wc2014_signup() {

        return View::make('v2.frontend.promo.wc2014_signup')
            ->withTitle('UnoTelly - Login');
 
	}


}