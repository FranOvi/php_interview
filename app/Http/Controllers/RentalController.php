<?php

namespace App\Http\Controllers;

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
}
