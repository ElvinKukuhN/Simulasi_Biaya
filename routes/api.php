<?php

use App\Http\Controllers\api\SimulasiBiayaController;
use App\Http\Controllers\api\SkorController;
use Illuminate\Support\Facades\Route;


Route::post('/simulasi-biaya-impor', [SimulasiBiayaController::class, 'simpan']);
Route::get('/skor', [SkorController::class, 'hitungSkor']);
