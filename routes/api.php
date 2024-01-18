<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CofeeController;
use App\Http\Controllers\DesertController;
use App\Http\Controllers\TransaksiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/cofee/{kategori}', [CofeeController::class, 'index' ]);
Route::get('/all', [CofeeController::class, 'allMenu' ]);
Route::resource('/dessert', DesertController::class );
Route::resource('/transaksi', TransaksiController::class );
