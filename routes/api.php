<?php

use Illuminate\Http\Request;

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

Route::namespace('Api')->group(function() {
    Route::namespace('Auth')->prefix('auth')->group(function() {
        Route::post('/login', 'AuthController@login');

        Route::middleware('auth:api')->group(function() {
            Route::get('/logout', 'AuthController@logout');
        });
    });

    Route::middleware(['auth:api'])->group(function() {
        Route::namespace('KelasActive')->prefix('kelas_active')->group(function() {
            Route::get('/', 'KelasActiveController@index');
        });

        Route::namespace('Kelas')->prefix('kelas')->group(function() {
            Route::get('/', 'KelasController@index');
        });

        Route::namespace('Dosen')->prefix('dosen')->group(function() {
            Route::namespace('Kelas')->prefix('kelas')->group(function() {
                Route::get('/', 'KelasController@index');
            });

            Route::namespace('KelasActive')->prefix('kelas_active')->group(function() {
                Route::post('/store', 'KelasActiveController@store');
                Route::post('/update', 'KelasActiveController@update');
            });
        });
    });
});

