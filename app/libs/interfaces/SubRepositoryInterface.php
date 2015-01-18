<?php

interface SubRepositoryInterface {

	public function cal_new_sub_time($sub_length);
	public function cal_old_sub_time($uid, $sub_length);
	public function insert_sub($uid, $sub_length, $product_id, $product_type);
	public function extend_sub($uid, $sub_length, $product_id, $product_type);
	public function create_sub($uid, $sub_length, $product_id, $product_type);
	public function change_status($uid, $status);
	public function init_sub($uid, $pkg_uniq_id, $product_id);
	public function extend_old_sub($uid, $pkg_uniq_id, $product_id);
	public function store_sub($uid, $pkg_uniq_id, $product_id);

    public function get_remaining_trial_days($uid);

	public function find_sub_info_legacy($uid);

    public function generate_confirmation_key($uid);
    public function check_confirmation_key($key);
    public function add_five_days_to_trial($current_uid);
    public function check_if_email_is_confirmed($current_uid);
    public function delete_confirmation_key($key);
    public function delete_existing_confirmation_keys($current_uid);

}
