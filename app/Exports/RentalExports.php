<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class RentalExports implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithColumnFormatting
{
    public function __construct(
        protected Collection $rental
    ) {
    }

    public function collection()
    {
        return $this->rental;
    }

    public function map($rental): array
    {
        return [
            $rental->id,
            $rental->title,
            $rental->latitude,
            $rental->longitude,
            $rental->advertiser,
            $rental->price,
            $rental->square_meter,
            $rental->rooms,
            $rental->bathrooms,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Title',
            'Latitude',
            'Longitude',
            'Advertiser',
            'Price',
            'Square Meters',
            'Rooms',
            'Bathrooms'
        ];
    }

    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER_00,
            'D' => NumberFormat::FORMAT_NUMBER_00,
            'F' => NumberFormat::FORMAT_CURRENCY_USD,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 18,
            'C' => 8,
            'D' => 8,
            'E' => 18,
            'F' => 10,
            'G' => 8,
            'H' => 8,
            'I' => 8,
        ];
    }
}
