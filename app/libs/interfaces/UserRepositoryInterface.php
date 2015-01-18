<?php

interface UserRepositoryInterface {

	public function find_user($uid);
	public function find_user_networks($uid);
	public function find_user_hash($uid);
	public function find_user_subs($uid);
	public function find_user_free($uid);
	public function assemble_user($uid);
    public function find_user_by_hash($user_hash);
    public function find_user_by_email($email);
	public function find_user_by_uid_hash($uid, $user_hash);
	public function prepare_hash($uid, $email, $ip_address);
	public function insert_hash($uid, $user_hash);
	public function create_hash_if_not_set($uid);
	public function create_user($firstname, $email, $password);
    public function new_user_init($ip_address, $uid, $email);

}