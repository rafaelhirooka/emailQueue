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
Route::get('/teste', function() {
    return view('mails.site.commercial-proposal', [
        'company' => 'Empresa X',
        'cnpj' => '48068453343504',
        'employees' => '5',
        'name' => 'Rafael',
        'email' => 'rafael@vegascard.com.br',
        'phone' => '9999999999999',
    ]);
});
Route::middleware('access')->group(function() {
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

        Route::prefix('site')->group(function() {
            Route::post('/accreditation', 'SiteController@accreditation');
            Route::post('/commercial-proposal', 'SiteController@commercialProposal');
        });
    });
});