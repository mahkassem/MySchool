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
            ],
            function () {
                Route::get('/', 'BuildingController@index');
                Route::post('/', 'BuildingController@create');
                Route::put('/', 'BuildingController@update');
                Route::delete('/{id}', 'BuildingController@delete');
            }
        );

        // Classroom routes group
        Route::group(
            [
                'prefix' => 'classrooms',
            ],
            function () {
                Route::get('/', 'ClassroomController@index');
                Route::get('/{id}', 'ClassroomController@show');
                Route::post('/', 'ClassroomController@create')->middleware(['auth:sanctum', 'admin']);
                Route::put('/', 'ClassroomController@update')->middleware(['auth:sanctum', 'admin']);
                Route::delete('/{id}', 'ClassroomController@delete')->middleware(['auth:sanctum', 'admin']);
            }
        );

        // Course routes group
        Route::group(
            [
                'prefix' => 'courses',
            ],
            function () {
                Route::get('/', 'CourseController@index');
                Route::get('/{id}', 'CourseController@show');
                Route::post('/', 'CourseController@create');
                Route::put('/', 'CourseController@update');
                Route::delete('/{id}', 'CourseController@delete');
                Route::post('/add-student', 'CourseController@addStudent');
                Route::post('/remove-student', 'CourseController@removeStudent');
            }
        );
    }
);
