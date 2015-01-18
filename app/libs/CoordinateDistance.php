<?php

class CoordinateDistance
{
    var $earth_radius_km;

    public function calculate($lat1, $lon1, $lat2, $lon2)
    {
        $this->earth_radius_km = 6371;
        $lat1_radian = deg2rad($lat1);
        $lat2_radian = deg2rad($lat2);

        $lon1_radian = deg2rad($lon1);
        $lon2_radian = deg2rad($lon2);

        $delta_lat = $lat2_radian - $lat1_radian;
        $delta_lon = $lon2_radian - $lon1_radian;

        $a = sin($delta_lat / 2);
        $b = cos($lat1_radian) * cos($lat2_radian);
        $c = sin($delta_lon / 2);

        $d = $a * $a + $b * $c * $c;

        $e = 2 * atan2(sqrt($d), sqrt(1 - $d));

        $distance = $this->earth_radius_km * $e;

        return $distance; //returning distance in km;

    }
}