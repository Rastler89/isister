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
use App\Http\Controllers\Api\SurgeryController;
use App\Http\Controllers\Api\MedicalController;
use App\Http\Controllers\Api\TreatmentController;
use App\Http\Controllers\Api\VisitController;

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

    Route::get('/surgeries/{id}',[SurgeryController::class, 'getSurgery']);
    Route::post('/surgeries/{id}',[SurgeryController::class, 'addSurgery']);
    Route::get('/surgeryType',[SurgeryController::class, 'getTypes']);

    Route::get('/treatments/{id}',[TreatmentController::class, 'getTreatment']);
    Route::post('/treatments/{id}',[TreatmentController::class, 'addTreatment']);

    Route::get('/visit/{id}',[VisitController::class, 'getVisit']);
    Route::post('/visit/{id}',[VisitController::class, 'addVisit']);

    Route::get('/medicals/{id}',[MedicalController::class, 'getMedical']);
    Route::post('/medicals/{id}',[MedicalController::class, 'addMedical']);
    Route::get('/medicalType',[MedicalController::class, 'getTypes']);
});

//Test TODO ELIMINAR
Route::get('/surgeries/types',[SurgeryController::class, 'getTypes']);
Route::get('/surgery/type',[SurgeryController::class, 'getTypes']);