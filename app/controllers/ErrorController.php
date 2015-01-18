<?php
class ErrorController extends BaseController {

	public function index()
	{
        $error_msg=Session::get('error_msg');
        var_dump($error_msg);
        die();
		$title = "Opps, something went wrong.";
		return View::make('errors.index')->with('error_msg',$error_msg);

	}
}