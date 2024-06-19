<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



// Route::group('middleware' => '\App\Http\Middleware\CrossOriginMiddleware', function () {
//     Route::get('/getSeed', [HomeController::class, 'getSeed']);
//     Route::get('/provable', [HomeController::class, 'provable']);
    

// });
Route::middleware([\App\Http\Middleware\CrossOriginMiddleware::class])->group(function () {
    Route::get('/getSeed', [HomeController::class, 'getSeed']);
    Route::get('/provable', [HomeController::class, 'provable']);
});