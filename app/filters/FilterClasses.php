<?php
use DynDnsRepositoryInterface as DynDnsInterface;

class CorrectDynDnsOwner {

    public function __construct(DynDnsInterface $dyndns_interface)
    {
        $this->dyndns_interface = $dyndns_interface;
    }

    public function filter($route)
    {
        $uid = Authenticate::is_logged_in();
        $dyndns_id = $route->getParameter('dyndns_id');
        $result = $this->dyndns_interface->correct_dyndns_owner($uid, $dyndns_id);
        if($result === FALSE)
        {
            App::abort(401, 'You are not authorized.');
        }
    }

}