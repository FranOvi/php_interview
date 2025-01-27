<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\RentalImportController;

Route::get('/rentals', [RentalController::class, 'index']);
Route::get('/rentals/geo/avg-sqm-price', [RentalController::class, 'avgPriceAt']);
Route::get('/rentals/export', [RentalController::class, 'export']);
Route::get('/rentals/import', RentalImportController::class);
