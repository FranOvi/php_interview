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
}
