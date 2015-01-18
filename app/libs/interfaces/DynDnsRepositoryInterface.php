<?php

interface DynDnsRepositoryInterface
{

	public function find_dyndns_by_id($dyndns_id);
	public function update_dyndns($dyndns_id, $hostname);

	public function correct_dyndns_owner($uid, $dyndns_id);
	public function find_active_network_by_hostname($hostname);
	public function find_dyndns_by_hostname($hostname);

}