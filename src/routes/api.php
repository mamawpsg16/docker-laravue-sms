<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\SchoolYearController;
use App\Http\Controllers\GuardianTypeController;
use App\Http\Controllers\App\AuthenticationController;
use App\Http\Controllers\StudentRegistrationController;

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
Route::middleware('auth:sanctum')->group(function(){
    Route::get('/user', [AuthenticationController::class, 'tokenVerification'])->middleware('user.authenticated');

    Route::apiResources([
        'genders' => GenderController::class,
        'guardian-types' => GuardianTypeController::class,
        'registrations' => StudentRegistrationController::class,
        'school-years' => SchoolYearController::class,
    ]);
    Route::get('/genderOptions', [GenderController::class,'getGenders']);
    Route::get('/guardianTypeOptions', [GuardianTypeController::class,'getGuardianTypes']);
    Route::get('/schoolYearOptions', [SchoolYearController::class,'getSchoolYears']);

});