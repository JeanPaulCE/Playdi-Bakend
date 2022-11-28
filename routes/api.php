<?php

use App\Http\Controllers\Game;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



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

Route::post('/register',   [AuthController::class, 'register']);
Route::post('/login',   [AuthController::class, 'login']);
Route::get('/', [AuthController::class, 'nan']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/validate', [Game::class, 'validate_']);
    Route::post('/cambios', [Game::class, 'cambios']);
    Route::post('/compartir', [Game::class, 'makeShare']);
    Route::post('/compartir/get', [Game::class, 'getShare']);
    Route::post('/logout', [AuthController::class, 'logout']);
});
