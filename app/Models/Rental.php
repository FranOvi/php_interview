<?php

namespace App\Models;

use App\Helpers\GeoHelper;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    public function scopeGeoSearch($query, $lat, $lon, $rad) {
        $bbox = GeoHelper::boundingBox($lat, $lon, $rad);
        return $query->selectRaw(
                '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                [$lat, $lon, $lat]
            )
            ->whereBetween('latitude', [$bbox['min_lat'], $bbox['max_lat']])
            ->whereBetween('longitude', [$bbox['min_lon'], $bbox['max_lon']])
            ->having('distance', '<', $rad);
    }
}
