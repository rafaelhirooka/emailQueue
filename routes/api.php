<?php

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

Route::prefix('mails')->group(function() {
    Route::prefix('app')->group(function() {
        Route::post('/recover-password-token', 'AppController@recoverPasswordToken');
        Route::post('/recover-password-token-ms', 'AppController@recoverPasswordTokenMS');
        Route::post('/register', 'AppController@register');
    });

    Route::prefix('covenant')->group(function() {
        Route::post('/register', 'CovenantController@register');
        Route::post('/register-ms', 'CovenantController@registerMS');
    });
});