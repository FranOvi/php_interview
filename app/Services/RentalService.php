<?php

namespace App\Services;

use App\Models\Rental;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;

class RentalService
{
    public function index(array $request): Collection
    {
        return $this->baseQuery($request)->get();
    }

    public function makeReport(array $request)
    {
        return $this->baseQuery($request)
            ->geoSearch($request['lat'], $request['lon'], $request['rad'])
            ->get();
    }

    public function avgPriceAt($lat, $lon, $rad = 10)
    {
        $rentals = Rental::query()
            ->select('title', 'latitude', 'longitude', 'price_per_sqm')
            ->geoSearch($lat, $lon, $rad)
            ->get();

        return [
            'results_count' => $rentals->count(),
            'average_price' => round($rentals->average('price_per_sqm'), 2),
        ];
    }

    private function baseQuery(array $request): Builder
    {
        return Rental::query()
            ->when($request['price_min'] ?? null, fn($q, $price) => $q->where('price', '>=', $price))
            ->when($request['price_max'] ?? null, fn($q, $price) => $q->where('price', '<=', $price))
            ->when($request['rooms'] ?? null, fn($q, $rooms) => $q->where('rooms', $rooms));
    }
}
