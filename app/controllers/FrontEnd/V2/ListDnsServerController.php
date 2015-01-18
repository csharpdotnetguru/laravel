<?php namespace FrontEnd\V2;

use App;
use BaseController;
use View;
use Authenticate;
use Exception;
use GeoIp;
use DnsServerRepositoryInterface as DnsServerInterface;
use UserRepositoryInterface as UserInterface;
use SubRepositoryInterface as SubInterface;

class ListDnsServerController extends BaseController
{

    public function __construct(UserInterface $user_interface, SubInterface $sub_interface, DnsServerInterface $dns_server_interface)
    {
        $this->user_interface = $user_interface;
        $this->sub_interface = $sub_interface;
        $this->dns_server_interface = $dns_server_interface;
        $this->uid = Authenticate::is_logged_in();
        $this->ip = $_SERVER['REMOTE_ADDR'];

        /* --- */
        // NOTE: can remove this when development is done
        if (App::environment('development')) {
            // check if ip not ::1 (when local)
            if (($this->ip === '::1') || ($this->ip === '127.0.0.1')) {
                // passing a sample ip
                $this->ip = '173.194.43.105';
            }
        }
        /* --- */
    }

    public function index()
    {
        // fetching user info based on ip
        $user_ip = $this->ip;

        try {
            $geoip = new GeoIp($user_ip);
        } catch (Exception $e) {
            $user_ip = '173.194.43.105'; //give user a default IP address if IP is not in DB
            $geoip = new GeoIp($user_ip);
        }


        $user_city = (strlen($geoip->get_city_name()) > 0) ? $geoip->get_city_name() : 'Unknown';

        // fetching all nearest servers
        $servers = $this->dns_server_interface->get_nearest_servers($user_ip);
        $markers = [];

        // preparing marker json
        $i = 0;
        foreach($servers as $server) {
            // prepare marker json for map
            $marker = [
                'name' => $server['server_city'] . ', ' . $server['server_country'] . ' - ' . $server['server_ip'],
                'latLng' => [$server['server_lat'], $server['server_long']],
            ];
            // pushing marker to collection
            array_push($markers, $marker);

            $i++;
        }

        // converting to json
        $json = json_encode($markers);

        //remove non dynamo server from dynamo server list
        $dynamo_servers = $servers;
        $a_size = count($dynamo_servers);

        for($i = 0; $i <$a_size; $i++) {
            if($dynamo_servers[$i]['server_type'] == 'non-dynamo') {
                unset($dynamo_servers[$i]);
            }
        }

        //reindex after removing items
        $dynamo_servers = array_values($dynamo_servers);

        $primary = $dynamo_servers[0];
        $secondary = $dynamo_servers[1];


        return View::make('v2.frontend.list_dns_servers.index',
            compact('user_ip', 'user_city', 'servers', 'json', 'primary', 'secondary'));
    }

}