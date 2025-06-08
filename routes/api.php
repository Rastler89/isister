<?php

use App\Http\Controllers\Api\ArticleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\SpecieController;
use App\Http\Controllers\Api\BreedController;
use App\Http\Controllers\Api\PetController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\DiseaseController;
use App\Http\Controllers\Api\VaccineController;
use App\Http\Controllers\Api\AllergyController;
use App\Http\Controllers\Api\WalkController;
use App\Http\Controllers\Api\DietController;
use App\Http\Controllers\Api\SurgeryController;
use App\Http\Controllers\Api\MedicalController;
use App\Http\Controllers\Api\TreatmentController;
use App\Http\Controllers\Api\VisitController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\ConstantController;

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
Route::group(['middleware' => ['auth:api','verified', 'check.subscription']], function() {

    Route::group(['prefix' => 'countries'], function () {
        Route::get('/',[CountryController::class, 'getCountries']);
        Route::get('/{id}/states',[CountryController::class, 'getStates']);
        Route::get('/states/{id}',[CountryController::class, 'getTownsByState']);
    });

    Route::post('/changePassword',[UserController::class, 'changePassword']);
    Route::post('/profile',[UserController::class, 'changeProfile']);
    Route::get('/profile',[UserController::class, 'getProfile']);

    Route::group(['prefix' => 'pets'], function() {
        Route::get('/',[PetController::class, 'pets']);
        Route::get('/{id}',[PetController::class, 'get']);
        Route::group(['middleware' => 'grade'], function() {
            Route::post('/', [PetController::class, 'add']);
            Route::post('/{id}',[PetController::class, 'addImage']);
            Route::put('/{id}',[PetController::class, 'update']);
            Route::post('/{id}/size',[ConstantController::class, 'addSize']);
            Route::post('/{id}/weight',[ConstantController::class, 'addWeight']);
            Route::put('/{id}/status',[PetController::class, 'changeStatus']);
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
        Route::put('/{id}/{allergyId}',[AllergyController::class, 'edit']);
    });

    Route::group(['prefix' => 'diets'], function() {
        Route::get('/{id}',[DietController::class, 'getDietsPet']);
        Route::post('/{id}',[DietController::class, 'add']);
        Route::delete('/{id}/{day}/{hour}',[DietController::class, 'delete']);
    });

    Route::group(['prefix' => 'walks'], function() {
        Route::get('/{id}',[WalkController::class, 'getWalksPet']);
        Route::post('/{id}',[WalkController::class, 'add']);
        Route::delete('/{id}/{day}/{hour}',[WalkController::class, 'delete']);
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

    Route::group(['prefix' => 'visits'], function() {
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

Route::get('/articles',[ArticleController::class, 'getArticles']);
Route::get('/articles/category/{slug}',[ArticleController::class, 'getArticlesByCategory']);
Route::get('/articles/{slug}',[ArticleController::class, 'getArticleBySlug']);

Route::post('/register',[UserController::class, 'store']);

Route::get('/public/pet/{hash}',[PetController::class, 'public']);

Route::get('/countries/full',[CountryController::class, 'fullVersion']);

// Dummy API Routes (No Middleware)
Route::group(['prefix' => 'dummy'], function () {

    // Countries
    Route::group(['prefix' => 'countries'], function () {
        Route::get('/',[App\Http\Controllers\Api\Dummy\DummyCountryController::class, 'getCountries']);
        Route::get('/{id}/states',[App\Http\Controllers\Api\Dummy\DummyCountryController::class, 'getStates']);
        Route::get('/states/{id}',[App\Http\Controllers\Api\Dummy\DummyCountryController::class, 'getTownsByState']); // Matches original structure
        Route::get('/full',[App\Http\Controllers\Api\Dummy\DummyCountryController::class, 'fullVersion']);
    });

    // User Profile (Simulated)
    // Note: /register is top-level in original, here it's dummy/register
    Route::post('/register',[App\Http\Controllers\Api\Dummy\DummyUserController::class, 'store']);
    Route::post('/changePassword',[App\Http\Controllers\Api\Dummy\DummyUserController::class, 'changePassword']);
    Route::post('/profile',[App\Http\Controllers\Api\Dummy\DummyUserController::class, 'changeProfile']);
    Route::get('/profile',[App\Http\Controllers\Api\Dummy\DummyUserController::class, 'getProfile']);

    // Pets
    // Note: /public/pet/{hash} is top-level in original, here it's dummy/public/pet/{hash}
    Route::get('/public/pet/{hash}',[App\Http\Controllers\Api\Dummy\DummyPetController::class, 'publicGet']);
    Route::group(['prefix' => 'pets'], function() {
        Route::get('/',[App\Http\Controllers\Api\Dummy\DummyPetController::class, 'pets']);
        Route::get('/{id}',[App\Http\Controllers\Api\Dummy\DummyPetController::class, 'get']);
        Route::post('/', [App\Http\Controllers\Api\Dummy\DummyPetController::class, 'add']);
        Route::post('/{id}',[App\Http\Controllers\Api\Dummy\DummyPetController::class, 'addImage']); // Original uses POST for image upload to pet ID
        Route::put('/{id}',[App\Http\Controllers\Api\Dummy\DummyPetController::class, 'update']);
        Route::post('/{id}/size',[App\Http\Controllers\Api\Dummy\DummyConstantController::class, 'addSize']);
        Route::post('/{id}/weight',[App\Http\Controllers\Api\Dummy\DummyConstantController::class, 'addWeight']);
        Route::put('/{id}/status',[App\Http\Controllers\Api\Dummy\DummyPetController::class, 'changeStatus']);
    });

    // Species & Breeds
    Route::group(['prefix' => 'species'], function() {
        Route::get('/', [App\Http\Controllers\Api\Dummy\DummySpecieController::class, 'getAll']);
        Route::get('/{id}/breeds', [App\Http\Controllers\Api\Dummy\DummyBreedController::class, 'getBySpecie']);
    });

    // Diseases
    Route::group(['prefix' => 'diseases'], function() {
        Route::get('/',[App\Http\Controllers\Api\Dummy\DummyDiseaseController::class, 'get']);
        Route::get('/{id}',[App\Http\Controllers\Api\Dummy\DummyDiseaseController::class, 'getBy']); // {id} is specie_id
    });

    // Vaccines
    Route::group(['prefix' => 'vaccines'], function() {
        Route::get('/{id}',[App\Http\Controllers\Api\Dummy\DummyVaccineController::class, 'getVaccinesPet']); // {id} is pet_id
        Route::post('/{id}',[App\Http\Controllers\Api\Dummy\DummyVaccineController::class, 'add']);
    });

    // Allergies
    Route::group(['prefix' => 'allergies'], function() {
        Route::get('/{id}',[App\Http\Controllers\Api\Dummy\DummyAllergyController::class, 'getAllergiesPet']); // {id} is pet_id
        Route::post('/{id}',[App\Http\Controllers\Api\Dummy\DummyAllergyController::class, 'add']);
        Route::put('/{id}/{allergyId}',[App\Http\Controllers\Api\Dummy\DummyAllergyController::class, 'edit']);
    });

    // Diets
    Route::group(['prefix' => 'diets'], function() {
        Route::get('/{id}',[App\Http\Controllers\Api\Dummy\DummyDietController::class, 'getDietsPet']); // {id} is pet_id
        Route::post('/{id}',[App\Http\Controllers\Api\Dummy\DummyDietController::class, 'add']);
        Route::delete('/{id}/{day}/{hour}',[App\Http\Controllers\Api\Dummy\DummyDietController::class, 'delete']);
    });

    // Walks
    Route::group(['prefix' => 'walks'], function() {
        Route::get('/{id}',[App\Http\Controllers\Api\Dummy\DummyWalkController::class, 'getWalksPet']); // {id} is pet_id
        Route::post('/{id}',[App\Http\Controllers\Api\Dummy\DummyWalkController::class, 'add']);
        Route::delete('/{id}/{day}/{hour}',[App\Http\Controllers\Api\Dummy\DummyWalkController::class, 'delete']);
    });

    // Surgeries
    // Note: /surgeryType is top-level in original authed group, here it's dummy/surgeryType
    Route::get('/surgeryType',[App\Http\Controllers\Api\Dummy\DummySurgeryController::class, 'getTypes']);
    Route::group(['prefix' => 'surgeries'], function() {
        Route::get('/{id}',[App\Http\Controllers\Api\Dummy\DummySurgeryController::class, 'getSurgery']); // {id} is pet_id
        Route::post('/{id}',[App\Http\Controllers\Api\Dummy\DummySurgeryController::class, 'addSurgery']);
    });

    // Medical Tests
    // Note: /medicalType is top-level in original authed group, here it's dummy/medicalType
    Route::get('/medicalType',[App\Http\Controllers\Api\Dummy\DummyMedicalController::class, 'getTypes']);
    Route::group(['prefix' => 'medicals'], function() {
        Route::get('/{id}',[App\Http\Controllers\Api\Dummy\DummyMedicalController::class, 'getMedical']); // {id} is pet_id
        Route::post('/{id}',[App\Http\Controllers\Api\Dummy\DummyMedicalController::class, 'addMedical']);
    });

    // Treatments
    Route::group(['prefix' => 'treatments'], function() {
        Route::get('/{id}',[App\Http\Controllers\Api\Dummy\DummyTreatmentController::class, 'getTreatment']); // {id} is pet_id
        Route::post('/{id}',[App\Http\Controllers\Api\Dummy\DummyTreatmentController::class, 'addTreatment']);
    });

    // Vet Visits
    Route::group(['prefix' => 'visits'], function() {
        Route::get('/{id}',[App\Http\Controllers\Api\Dummy\DummyVisitController::class, 'getVisit']); // {id} is pet_id
        Route::post('/{id}',[App\Http\Controllers\Api\Dummy\DummyVisitController::class, 'addVisit']);
    });

    // Articles
    // Note: These are top-level in original, here they are under dummy/articles/*
    Route::group(['prefix' => 'articles'], function () {
        Route::get('/',[App\Http\Controllers\Api\Dummy\DummyArticleController::class, 'getArticles']);
        Route::get('/category/{slug}',[App\Http\Controllers\Api\Dummy\DummyArticleController::class, 'getArticlesByCategory']);
        Route::get('/{slug}',[App\Http\Controllers\Api\Dummy\DummyArticleController::class, 'getArticleBySlug']);
    });
});
