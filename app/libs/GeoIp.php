<?php
use GeoIp2\Database\Reader;

class GeoIp
{

    public function __construct($user_ip)
    {
        $reader = new Reader(app_path() . '/libs/geoip/GeoLite2-City.mmdb');

        try {
            $this->city_record = $reader->city($user_ip);
            $this->location = $this->city_record->location;
        } catch (AddressNotFoundException $e) {
            // if no ip is found, use default
            $user_ip = '154.73.225.68';
            $this->city_record = $reader->city($user_ip);
            $this->location = $this->city_record->location;
        }
    }

    public function get_coordinate()
    {
        return [
            'lat' => $this->location->latitude,
            'lon' => $this->location->longitude
        ];
    }

    public function get_city_name()
    {
        return $this->city_record->city->name;
    }

    public function get_province_name()
    {
        return $this->city_record->mostSpecificSubdivision->name;
    }

}