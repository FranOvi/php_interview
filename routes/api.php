<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\RentalImportController;

Route::get('/rentals', [RentalController::class, 'index']);
Route::get('/rentals/import', RentalImportController::class);
