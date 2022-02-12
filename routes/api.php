<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TokenController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(array('middleware' => ['custom_auth']), function ()
{
    Route::apiResource('token', TokenController::class);
    Route::post('/token/topup', [TokenController::class, 'store']);
});

Route::get('genre', [ApiController::class, 'genre']);
Route::get('timeslot', [ApiController::class, 'timeslot']);
Route::get('specific_movie_theater', [ApiController::class, 'specificMovieTheater']);
Route::get('search_performer', [ApiController::class, 'searchPerformer']);
Route::post('give_rating', [ApiController::class, 'giveRating']);
Route::get('new_movies', [ApiController::class, 'newMovies']);
Route::post('add_movie', [ApiController::class, 'addMovie']);