<?php

namespace App\Services;

use App\Models\Rental;
use Carbon\Carbon;

class RentalImportService
{
    const HEADER_MAP = [
        'ID' => 'id',
        'Latitud' => 'latitude',
        'Longitud' => 'longitude',
        'Titulo' => 'title',
        'Anunciante' => 'advertiser',
        'Descripcion' => 'description',
        'Reformado' => 'reformed',
        'Telefonos' => 'phone_number',
        'Tipo' => 'type',
        'Precio' => 'price',
        'Precio por metro' => 'price_per_sqm',
        'Direccion' => 'address',
        'Provincia' => 'province',
        'Ciudad' => 'city',
        'Metros cuadrados' => 'square_meter',
        'Habitaciones' => 'rooms',
        'Baños' => 'bathrooms',
        'Parking' => 'parking',
        'Segunda mano' => 'second_hand',
        'Armarios Empotrados' => 'built_in_closet',
        'Construido en' => 'built_in_year',
        'Amueblado' => 'furnished',
        'Calefacción individual' => 'individual_heating',
        'Certificación energética' => 'energy_certification',
        'Planta' => 'floors',
        'Exterior' => 'exterior',
        'Interior' => 'interior',
        'Ascensor' => 'elevator',
        'Fecha' => 'date',
        'Calle' => 'street',
        'Barrio' => 'neighbourhood',
        'Distrito' => 'district',
        'Terraza' => 'terrace',
        'Trastero' => 'storage_room',
        'Cocina Equipada' => 'equipped_kitchen',
        'Aire acondicionado' => 'air_conditioner',
        'Piscina' => 'pool',
        'Jardín' => 'garden',
        'Metros cuadrados útiles' => 'usable_square_meter',
        'Apto para personas con movilidad reducida' => 'reduced_mobility_suitable',
        'Se admiten mascotas' => 'pets_allowed',
        'Balcón' => 'balcony',
    ];

    const boolean_columns = ['reformed', 'parking', 'second_hand', 'built_in_closet', 'furnished', 'energy_certification', 'exterior', 'interior', 'elevator', 'terrace', 'storage_room', 'equipped_kitchen', 'air_conditioner', 'pool', 'garden', 'reduced_mobility_suitable', 'pets_allowed', 'balcony'];
    const integer_columns = ['rooms', 'bathrooms', 'built_in_year', 'floors'];
    const decimal_columns = ['latitude', 'longitude', 'price', 'price_per_sqm', 'square_meter', 'usable_square_meter'];
    const date_columns = ['date'];
    const not_nullable_columns = ['description'];

    private function columnValue($column, $value) {
        if ($value === '' && !in_array($column, self::not_nullable_columns)) return null;
        try {
            if (in_array($column, self::boolean_columns)) return boolval($value);
            if (in_array($column, self::integer_columns)) return intval($value);
            if (in_array($column, self::decimal_columns)) return floatval($value);
            if (in_array($column, self::date_columns)) return Carbon::createFromFormat('m/d/Y', $value); //Carbon::parse($value)->format('m/d/Y');
        } catch(\Exception $e) {
            return null;
        }
        return strval($value);
    }


    public function importRentalFromCSV($csvFile)
    {
        $path = storage_path("import/$csvFile");

        $file_handle = fopen($path, 'r');

        $headers = fgetcsv($file_handle, null, ',');
        $headers = array_map(fn($h) => self::HEADER_MAP[$h] ?? '', $headers);

        while ($csvRow = fgetcsv($file_handle, null, ',')) {
            for ($i=0; $i < count($csvRow); $i++) {
                if ($header = $headers[$i]) {
                    $row[$header] = $this->columnValue($header, $csvRow[$i]);
                }
            }

            $rows[] = $row;
        }
        fclose($file_handle);

        $headers = array_filter($headers, fn($h) => $h && $h !== 'id');


        Rental::upsert($rows, uniqueBy: ['id'], update: $headers);
    }
}
