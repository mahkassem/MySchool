<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(
    [
        'namespace' => 'App\Http\Controllers',
        'middleware' => 'api',
    ],
    function () {

        // Auth routes
        Route::group(
            [
                'prefix' => 'auth',
            ],
            function () {
                Route::post('register', 'AuthController@register');
                Route::post('login', 'AuthController@login');
            }
        );

        // Building routes group
        Route::group(
            [
                'prefix' => 'buildings',
                'middleware' => ['auth:sanctum'],
            ],
            function () {
                Route::get('/', 'BuildingController@index');
                Route::post('/', 'BuildingController@create')->middleware('auth:sanctum');
                Route::put('/', 'BuildingController@update')->middleware('auth:sanctum');
                Route::delete('/{id}', 'BuildingController@delete')->middleware('auth:sanctum');
            }
        );
    }
);
