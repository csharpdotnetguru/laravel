<?php

use DnsServerRepositoryInterface as DnsServerInterface;

class DnsServerController extends BaseController {

    public function __construct(DnsServerInterface $dns_servers)
    {
        $this->dns_servers = $dns_servers;
    }

    /**
     * Get all Record From list_dns_servers
     */
    public function get_all() {
    	return $this->dns_servers->get_all();
    }
}
