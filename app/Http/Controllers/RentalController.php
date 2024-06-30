<?php

namespace App\Http\Controllers;

use App\Http\Requests\RentalGeoRequest;
use App\Services\RentalService;
use Illuminate\Http\Request;
use App\Exports\RentalExports;
use Maatwebsite\Excel\Facades\Excel;

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

    public function export(Request $request)
    {
        $rentals = $this->rentalService->makeReport($request->except('export_type'));

        $exportType = $request->get('export_type', 'csv');
        $date = date("m-d-Y_His");
        $filePath = "export/rentals_$date.$exportType";
        $writerType = match ($exportType) {
            'csv' => \Maatwebsite\Excel\Excel::CSV,
            'pdf' => \Maatwebsite\Excel\Excel::DOMPDF,
            default => \Maatwebsite\Excel\Excel::CSV,
        };

        Excel::store(new RentalExports($rentals), $filePath, 'public', $writerType);
        return response()->json(['message' => 'success', 'filePath' => $filePath]);
    }

    public function avgPriceAt(RentalGeoRequest $request)
    {
        ['lat' => $lat, 'lon' => $lon, 'rad' => $rad] = $request->validated();
        return $this->rentalService->avgPriceAt($lat, $lon, $rad);
    }
}
