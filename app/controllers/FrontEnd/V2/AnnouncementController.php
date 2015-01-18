<?php namespace FrontEnd\V2;

use BaseController;
use View;
use Input;
use Session;
use Exception;
use App;
use UserRepositoryInterface as UserInterface;
use SubRepositoryInterface as SubInterface;
use Response;

use Network;
use Authenticate;

class AnnouncementController extends BaseController 
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

	public function get_announcement() {
	

		$misc_interface = App::make('MiscRepositoryInterface');
		$announcements = $misc_interface->get_announcements();
		if($announcements === NULL) {
			$data = [
				'status' => FALSE
			];
			return Response::json($data);
		}

		$data = [
			'status' => TRUE,
		];

		$data['data'] = [];

		foreach($announcements as $announcement) {
			array_push($data['data'], ['content' => $announcement->content]);
		}

		return Response::json($data);

	}


}