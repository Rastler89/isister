<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SpecieController;
use App\Http\Controllers\Api\BreedController;
use App\Http\Controllers\Api\PetController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DiseaseController;
use App\Http\Controllers\Api\VaccineController;
use App\Http\Controllers\Api\AllergyController;
use App\Http\Controllers\Api\DietController;

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
    Route::post('/pets', [PetController::class, 'add']);
    Route::post('/pets/{id}',[PetController::class, 'addImage']);
    Route::get('/pets/{id}',[PetController::class, 'get']);
    Route::put('/pets/{id}',[PetController::class, 'update']);

    Route::get('/diseases',[DiseaseController::class, 'get']);
    Route::get('/diseases/{id}',[DiseaseController::class, 'getBy']);

    Route::get('/vaccines/{id}',[VaccineController::class, 'getVaccinesPet']);
    Route::post('/vaccines/{id}',[VaccineController::class, 'add']);

    Route::get('/allergies/{id}',[AllergyController::class, 'getAllergiesPet']);
    Route::post('/allergies/{id}',[AllergyController::class, 'add']);

    Route::get('/diets/{id}',[DietController::class, 'getDietsPet']);
    Route::post('/diets/{id}',[DietController::class, 'add']);
    Route::delete('/diets/{id}/{day}/{hour}',[DietController::class, 'delete']);

    Route::get('/profile',[UserController::class, 'profile']);
    Route::get('/profile/methods',[UserController::class, 'payments_method']);
});

//Test TODO ELIMINAR
Route::get('/diets/{id}',[DietController::class, 'getDietsPet']);

//Route::post('/register', [RegisterController::class, 'register']);