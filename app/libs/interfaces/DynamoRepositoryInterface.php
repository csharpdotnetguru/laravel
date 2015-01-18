<?php

interface DynamoRepositoryInterface
{

    public function find_active_dyn_channels();

    public function find_channel_options($channel_id);

    public function find_dyn_pref($uid, $channel_id);

    public function assemble_channels();

    public function assemble_dyn_prefs($uid);

    public function update_dyn_pref($uid, $channel_id, $country_id);

    public function store_dyn_pref($uid, $channel_id, $country_id);

    public function viewData();

    public function get_channel_info();

    public function get_user_channel_pref($uid, $dynchannel_id);

    public function getFlag($country_code);

    public function get_channel_options($dynChannel_id);

    public function get_channel_url($dyn_channel_assoc_id);


    public function process_ajax($uid, $channel, $country_id, $server_code);
}
