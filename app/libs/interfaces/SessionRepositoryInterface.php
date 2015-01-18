<?php

interface SessionRepositoryInterface
{
		public function redirect_path($uid);

		public function generate_session_code();
   	 	public function auth_session_code($uid, $input_session_code);
   	 	public function insert_session_code($uid);
}