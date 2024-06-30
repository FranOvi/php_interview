<?php

namespace App\Helpers;

class GeoHelper
{
    public static function boundingBox($lat, $lon, $rad = 10)
    {
        $earth_radius = 6371;
        $min_lat = $lat - rad2deg($rad / $earth_radius);
        $max_lat = $lat + rad2deg($rad / $earth_radius);
        $min_lon = $lon - rad2deg(asin($rad / $earth_radius) / cos(deg2rad($lat)));
        $max_lon = $lon + rad2deg(asin($rad / $earth_radius) / cos(deg2rad($lat)));
        return compact('min_lat', 'max_lat', 'min_lon', 'max_lon');
    }
}
