<?php

namespace App\Http\Controllers;

use App\Services\RentalImportService;
use Illuminate\Http\Request;

class RentalImportController extends Controller
{
    public function __construct(
        public RentalImportService $rentalImportService
    ) {
    }

    public function __invoke(Request $request)
    {
        $fileName = $request->get('file_name', 'resource_accommodation.csv');
        $this->rentalImportService->importRentalFromCSV($fileName);
        return response()->json(['message' => 'success']);
    }
}
