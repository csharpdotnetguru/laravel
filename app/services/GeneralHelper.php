<?php

class GeneralHelper {

	public static function is_debug_on() {
		$debug_option = Config::get('app.debug');
		if($debug_option == 'TRUE') {
			return TRUE;
		}
		return FALSE;
	}
}