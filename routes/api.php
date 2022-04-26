<?php

use App\Http\Controllers\ShiftController;
use Illuminate\Support\Facades\Route;

Route::post('/create', [ShiftController::class, 'bulkCreate']);
Route::post('/search', [ShiftController::class, 'search']);
Route::post('/delete', [ShiftController::class, 'deleteAllData']);
