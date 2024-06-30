<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalGeoRequest;
use App\Services\RentalService;
use Illuminate\Http\Request;

class RentalController extends Controller
{
    public function __construct(
        public RentalService $rentalService
    ) {
    }

    public function index(Request $request)
    {
        return $this->rentalService->index($request->all());
    }

    public function report(Request $request)
    {
        return $this->rentalService->makeReport($request->all());
    }

    public function avgPriceAt(RentalGeoRequest $request)
    {
        ['lat' => $lat, 'lon' => $lon, 'rad' => $rad] = $request->validated();
        return $this->rentalService->avgPriceAt($lat, $lon, $rad);
    }
}
