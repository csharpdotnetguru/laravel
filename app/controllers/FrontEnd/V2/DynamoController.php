<?php namespace FrontEnd\V2;

use BaseController;
use View;
use Input;
use Session;
use Exception;
use App;
use UserRepositoryInterface as UserInterface;
use DynamoRepositoryInterface as DynamoInterface;
use Network;
use Authenticate;

class DynamoController extends BaseController 
{

	public function __construct(UserInterface $user_interface, DynamoInterface $dynamo_interface) {
		$this->user_interface = $user_interface;
		$this->dynamo_interface = $dynamo_interface;
		$this->uid = Authenticate::is_logged_in();
		$this->ip = $_SERVER['REMOTE_ADDR'];
	}

	public function index() {
 		$title = "UnoTelly - Dynamo Setting: Choose your favourite streaming.";

        $settings = $this->dynamo_interface->viewData();
		return View::make('v2.frontend.dynamo.index')
            ->with('settings', $settings)
            ->with('member', Authenticate::member())
            ->with('uid', $this->uid)
            ->with('title', $title)
            ->with('change_setting','active');

	}


}