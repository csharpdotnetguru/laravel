<?php

interface DnsServerRepositoryInterface
{
    public function get_all();
    public function get_all_dynamo_servers();
    public function get_nearest_servers($user_ip, $dynamo_only = false);
}