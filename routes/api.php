<?php



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

require_once('route_api.php');
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('city', App\Http\Controllers\CityController::class);

Route::apiResource('leveleducation', App\Http\Controllers\LeveleducationController::class);

Route::apiResource('subject', App\Http\Controllers\SubjectController::class);

Route::apiResource('user', App\Http\Controllers\UserController::class);

Route::apiResource('tutor', App\Http\Controllers\TutorController::class);

Route::apiResource('tutor-sub', App\Http\Controllers\TutorSubController::class);

Route::apiResource('lessson', App\Http\Controllers\LesssonController::class);

Route::apiResource('tutor-level-education', App\Http\Controllers\TutorLevelEducationController::class);

Route::apiResource('review', App\Http\Controllers\ReviewController::class);
