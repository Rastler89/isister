<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SpecieController;
use App\Http\Controllers\Api\BreedController;
use App\Http\Controllers\Api\PetController;

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

Route::group(['middleware' => ['auth:api']], function() {
    Route::get('/test', function(Request $request) {
        return $request->user()->id;
    });

    Route::get('/species', [SpecieController::class, 'getAll']);
    Route::get('/species/{id}/breeds', [BreedController::class, 'getBySpecie']);

    Route::get('/pets',[PetController::class, 'pets']);
    Route::get('/pets/count', [PetController::class, 'count']);
    Route::post('/pets/add', [PetController::class, 'add']);
});


Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
})->middleware('web');

//Route::post('/register', [RegisterController::class, 'register']);