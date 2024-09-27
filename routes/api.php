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

    Route::post('/changePassword',[UserController::class, 'changePassword']);

    Route::group(['prefix' => 'pets'], function() {
        Route::get('/',[PetController::class, 'pets']);
        Route::get('/{id}',[PetController::class, 'get']);
        Route::group(['middleware' => 'grade'], function() {
            Route::post('/', [PetController::class, 'add']);
            Route::post('/{id}',[PetController::class, 'addImage']);
            Route::put('/{id}',[PetController::class, 'update']);
        });
    });

    Route::group(['prefix' => 'species'], function() {
        Route::get('/', [SpecieController::class, 'getAll']);
        Route::get('/{id}/breeds', [BreedController::class, 'getBySpecie']);
    });

    Route::group(['prefix' => 'diseases'], function() {
        Route::get('/',[DiseaseController::class, 'get']);
        Route::get('/{id}',[DiseaseController::class, 'getBy']);
    });

    Route::group(['prefix' => 'vaccines'], function() {
        Route::get('/{id}',[VaccineController::class, 'getVaccinesPet']);
        Route::post('/{id}',[VaccineController::class, 'add']);
    });

    Route::group(['prefix' => 'allergies'], function() {
        Route::get('/{id}',[AllergyController::class, 'getAllergiesPet']);
        Route::post('/{id}',[AllergyController::class, 'add']);
    });

    Route::group(['prefix' => 'diets'], function() {
        Route::get('/{id}',[DietController::class, 'getDietsPet']);
        Route::post('/{id}',[DietController::class, 'add']);
        Route::delete('/{id}/{day}/{hour}',[DietController::class, 'delete']);
    });

    Route::group(['prefix' => 'profile'], function() {
        Route::get('/',[UserController::class, 'profile']);
        Route::get('/methods',[UserController::class, 'payments_method']);
    });

    Route::group(['prefix' => 'surgeries'], function() {
        Route::get('/{id}',[SurgeryController::class, 'getSurgery']);
        Route::post('/{id}',[SurgeryController::class, 'addSurgery']);
    });
    
    Route::group(['prefix' => 'treatments'], function() {
        Route::get('/{id}',[TreatmentController::class, 'getTreatment']);
        Route::post('/{id}',[TreatmentController::class, 'addTreatment']);
    });
    
    Route::group(['prefix' => 'visit'], function() {
        Route::get('/{id}',[VisitController::class, 'getVisit']);
        Route::post('/{id}',[VisitController::class, 'addVisit']);
    });
    
    Route::group(['prefix' => 'medicals'], function() {
        Route::get('/{id}',[MedicalController::class, 'getMedical']);
        Route::post('/{id}',[MedicalController::class, 'addMedical']);
    });
    
    Route::get('/medicalType',[MedicalController::class, 'getTypes']);
    Route::get('/surgeryType',[SurgeryController::class, 'getTypes']);

});

//Test TODO ELIMINAR
Route::post('/register',[UserController::class, 'store']);
Route::get('/diseasesget',[DiseaseController::class, 'get']);