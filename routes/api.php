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

Route::post('/login', 'API\AuthController@login');
Route::post('check_token', 'API\AuthController@check_token')->name('check_token');

Route::group(['middleware' => 'jwt.verify'], function () {
    Route::put('/change-pass', 'API\AuthController@changePassword');
    Route::post('/logout', 'API\AuthController@logout');
    Route::get('/check-status', 'API\AuthController@me');

    Route::group(['prefix' => 'master-user'], function() {
        Route::get('/', 'API\UserController@index');
        Route::post('/store', 'API\UserController@store');
        Route::get('/get-pimpinan', 'API\UserController@getPimpinan');
        Route::get('/detail/{id}', 'API\UserController@show');
        Route::put('/update/{id}', 'API\UserController@update');
        Route::patch('/change-status/{id}', 'API\UserController@changeStatus');
        Route::delete('/delete/{id}', 'API\UserController@destroy');
    });

    Route::get('/organization-structure/index', 'API\UserController@structure');

    Route::group(['prefix' => 'master-data'], function() {
        Route::post('perspectives/{id}/switch-status', 'API\PerspectiveController@switchStatus');
        Route::resource('perspectives', 'API\PerspectiveController');
        
        Route::post('strategic-targets/{id}/switch-status', 'API\StrategicTargetController@switchStatus');
        Route::resource('strategic-targets', 'API\StrategicTargetController');

        Route::get('/', 'API\MasterParameterController@index');
        Route::get('/get-perspective', 'API\MasterParameterController@getPerspective');
        Route::get('/get-strategic-target', 'API\MasterParameterController@getStrategicTarget');
        Route::get('/get-type-ytd', 'API\MasterParameterController@getTypeYtd');
        Route::get('/get-kondisi', 'API\MasterParameterController@getKondisi');
        Route::post('/store', 'API\MasterParameterController@storeParameter');
        Route::post('/store-perspective', 'API\MasterParameterController@storePerspective');
        Route::post('/store-strategic-target', 'API\MasterParameterController@storeStrategicTarget');
        Route::get('/show/{id}', 'API\MasterParameterController@show');
        Route::put('/update/{id}', 'API\MasterParameterController@update');
        Route::delete('/delete-parameter/{id}', 'API\MasterParameterController@deleteParameter');
        Route::patch('/change-status/{id}', 'API\MasterParameterController@changeStatus');
    });

    Route::group(['prefix' => 'setting-parameter'], function() {
        Route::get('/', 'API\SettingParameterController@index');
        Route::put('/update/{id}', 'API\SettingParameterController@update');
        Route::get('/detail/{id}', 'API\SettingParameterController@show');
    });

    Route::group(['prefix' => 'setting-mapping-score'], function() {
        Route::get('/', 'API\SettingMappingScoreController@index');
        Route::put('/update/{id}', 'API\SettingMappingScoreController@update');
        Route::get('/detail/{id}', 'API\SettingMappingScoreController@show');
    });

    Route::group(['prefix' => 'setting-kpi'], function() {
        Route::resource('target-years', 'API\TargetYearController');

        Route::get('targets', 'API\TargetController@index');
        Route::post('targets', 'API\TargetController@store');
        Route::get('targets/{id}', 'API\TargetController@show');
        Route::delete('targets/{id}', 'API\TargetController@destroy');

        Route::post('targets/approve', 'API\TargetController@approve');
        Route::post('targets/reject/{id}', 'API\TargetController@reject');

        Route::get('target-units', 'API\TargetUnitController@index');
        Route::get('target-parameters', 'API\TargetParameterController@index');

        Route::resource('condition-formula-years', 'API\ConditionFormulaYearController');
        Route::resource('condition-formulas', 'API\ConditionFormulaController');
    });

    Route::post('realization-evidence', 'API\RealizationEvidenceController@store');
    Route::get('realization-evidence/{evidence}', 'API\RealizationEvidenceController@show');

    Route::get('realizations', 'API\RealizationController@index');
    Route::get('realizations/performance-values', 'API\RealizationController@performanceValueIndex');
    Route::post('realizations/save', 'API\RealizationController@save');
    Route::post('realizations/lock', 'API\RealizationController@lock');
    Route::post('realizations/collective-lock', 'API\RealizationController@collectiveLock');
    
    Route::post('realizations/approve', 'API\RealizationController@approve');
    Route::post('realizations/{realization}/reject', 'API\RealizationController@reject');
    
    Route::post('realizations/{realization}/change-requests', 'API\RealizationChangeRequestController@store');
    Route::get('realizations/{realization}/change-requests/{changeRequest}', 'API\RealizationChangeRequestController@show');
    Route::post('realizations/{realization}/change-requests/{changeRequest}/approve', 'API\RealizationChangeRequestController@approve');
    Route::post('realizations/{realization}/change-requests/{changeRequest}/reject', 'API\RealizationChangeRequestController@reject');
    
    Route::post('realizations/{realization}/picas', 'API\RealizationPicaController@store');
    Route::get('realizations/{realization}/picas/{pica}', 'API\RealizationPicaController@show');

    Route::post('realizations/{realization}/picas/{pica}/evidence/initial-attachment', 'API\RealizationPicaEvidenceController@initialStore');
    Route::post('realizations/{realization}/picas/{pica}/evidence/correction-attachment', 'API\RealizationPicaEvidenceController@correctionStore');

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('verifications-status', 'API\DashboardController@verificationStatusIndex');
        Route::get('realization-graph', 'API\DashboardController@realizationGraphIndex');
        Route::get('mapping-score', 'API\DashboardController@mappingScoreIndex');
    });

    Route::get('notifications', 'API\NotificationController@index');
    Route::post('notifications', 'API\NotificationController@markAsRead');
    Route::post('notifications/marks', 'API\NotificationController@markAllAsRead');
    Route::delete('notifications', 'API\NotificationController@destroy');

    Route::get('/navigation-drawer', 'API\NavigationDrawerController@index');

    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('verification-status', 'API\DashboardController@verificationStatusIndex');
    });
});
