<?php

use App\Http\Controllers\VoteElecteurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoteCandidatController;
use App\Http\Controllers\Admin\VoteController;
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


//Authentification
Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'store']);

Route::middleware('auth:sanctum')->group(function () {
    // Routes protégées

});

    //Utils
    Route::post('check_email',[AuthController::class,'check_email']);

    //organisateurs
    Route::resource('vote', VoteController::class);
    Route::post('create_vote', [VoteController::class, 'store']);
    Route::resource('vote_candidat', VoteCandidatController::class);
    Route::resource('vote_electeur', VoteElecteurController::class);
    Route::post('filter_user/{role?}',[AuthController::class,'index']);
    Route::post('electeur_has_voted',[VoteElecteurController::class,'if_electeur_vote_candidat']);

    //electeurs
    Route::resource('user', AuthController::class);
    Route::post('filter_votes/{statut?}/{user_id?}',[VoteController::class,'index']);


