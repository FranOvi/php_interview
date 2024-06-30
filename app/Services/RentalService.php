<?php

namespace App\Services;

use App\Models\Rental;
use Illuminate\Database\Eloquent\Collection;

class RentalService
{
    public function index(array $request): Collection
    {
        return Rental::query()
            ->when($request['price_min'] ?? null, fn($q, $price) => $q->where('price', '>=', $price))
            ->when($request['price_max'] ?? null, fn($q, $price) => $q->where('price', '<=', $price))
            ->when($request['rooms'] ?? null, fn($q, $rooms) => $q->where('rooms', $rooms))
            ->get();
    }

    public function avgPriceAt($lat, $lon, $rad = 10)
    {
        $bbox = $this->generateBoundingBox($lat, $lon, $rad);
        $rentals = Rental::query()
            ->select('title', 'latitude', 'longitude', 'price_per_sqm')
            ->selectRaw(
                '(6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                [$lat, $lon, $lat]
            )
            ->whereBetween('latitude', [$bbox['min_lat'], $bbox['max_lat']])
            ->whereBetween('longitude', [$bbox['min_lon'], $bbox['max_lon']])
            ->having('distance', '<', $rad)
            ->get();

        return [
            'results_count' => $rentals->count(),
            'average_price' => round($rentals->average('price_per_sqm'), 2),
        ];
    }

    private function generateBoundingBox($lat, $lon, $rad = 10)
    {
        $earth_radius = 6371;
        $min_lat = $lat - rad2deg($rad / $earth_radius);
        $max_lat = $lat + rad2deg($rad / $earth_radius);
        $min_lon = $lon - rad2deg(asin($rad / $earth_radius) / cos(deg2rad($lat)));
        $max_lon = $lon + rad2deg(asin($rad / $earth_radius) / cos(deg2rad($lat)));
        return compact('min_lat', 'max_lat', 'min_lon', 'max_lon');
    }
}
