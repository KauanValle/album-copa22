<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getFigurinha', 'FigurinhaController@index');

Route::group(['middleware' => ['apiJwt']], function (){
    Route::prefix('/user')->group(
        function () {
            Route::post('/create', 'UserController@create');
            Route::get('/getAll', 'UserController@getAllUsers');
        }
    );
});


Route::post('login', 'AuthController@login');
Route::post('logout', 'AuthController@logout');
Route::post('refresh', 'AuthController@refresh');
Route::post('me', 'AuthController@me');
