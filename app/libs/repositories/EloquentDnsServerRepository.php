<?php

class EloquentDnsServerRepository implements DnsServerRepositoryInterface
{

    /**
     * Get all Record From list_dns_servers
     */
    public function get_all()
    {
        return DnsServer::where('display', '=', 1)->get();
    }

    public function get_all_dynamo_servers() {
        return DnsServer::where('display', '=', 1)->where('server_type', '=', 'dynamo')->get();
    }

    public function get_nearest_servers($user_ip, $dynamo_only = false)
    {
        $coordinateDistance = new CoordinateDistance();

        // getting user spatial coordinates based on user ip
        try {
            $geoip = new GeoIp($user_ip);
        } catch (Exception $e) {
            $user_ip = '173.194.43.105'; //give user a default IP address if IP is not in DB
            $geoip = new GeoIp($user_ip);
        }

        $user_coords = $geoip->get_coordinate();

        if ($dynamo_only) {
            // fetching only dynamo servers
            $servers = $this->get_all_dynamo_servers();

        } else {
            // fetching all servers
            $servers = $this->get_all();
        }

        $servers = $servers->toArray();

        $i = 0;
        foreach ($servers as $server) {
            // calculating distance between user and server then rounding it
            $distance = round($coordinateDistance->calculate($user_coords['lat'], $user_coords['lon'],
                $server['server_lat'], $server['server_long']));
            // injecting distance in servers collection
            $servers[$i]['distance'] = $distance;
            $i++;
        }

        // sorting on distance
        $servers = Utils::array_sort($servers, 'distance');

        // rebuilding array index
        $servers = array_values(array_filter($servers));

        return $servers;
    }

}