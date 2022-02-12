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
Route::get('timeslot', 'ApiController@timeslot');
Route::get('specific_movie_theater', 'ApiController@specificMovieTheater');
Route::get('search_performer', 'ApiController@searchPerformer');
Route::post('give_rating', 'ApiController@giveRating');
Route::get('new_movies', 'ApiController@newMovie');
Route::post('add_movie', 'ApiController@addMovie');