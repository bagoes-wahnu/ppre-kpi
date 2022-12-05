<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

Route::get('/', function () {
    return view('login');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/account-list', function () {
    return view('account-list');
});

//Master
Route::prefix('master')->group(function () {
    //Master Data
	Route::prefix('data')->group(function () {
        Route::get('/', function () {
             return view('master.data.grid');
         });
     });
    //Master User
	Route::prefix('user')->group(function () {
	   Route::get('/', function () {
		    return view('master.user.grid');
		});
	});
    //Master Setting
    Route::get('/setting-nilai-parameter', function () {
        return view('master.setting.nilai-parameter');
    });
    Route::get('/setting-mapping-score', function () {
        return view('master.setting.mapping-score');
    });
});

//Setting kpi
Route::prefix('setting-kpi')->group(function () {
    Route::get('/', function () {
        return view('setting.index');
    });
    Route::get('/{id}', function ($id) {
        return view('setting.setting-kpi',['id'=>$id]);
    });
});

Route::prefix('realisasi-kpi')->group(function () {
    Route::get('/', function () {
        return view('realisasi.index');
    });
    // Route::get('/{id}', function ($id) {
    //     return view('realisasi.realisasi-kpi',['id'=>$id]);
    // });
});


//Setting Rumus kondisi
Route::prefix('setting-rumus')->group(function () {
    Route::get('/', function () {
        return view('setting-rumus-kondisi.index');
    });
    Route::get('/{id}', function ($id) {
        return view('setting-rumus-kondisi.detail',['id'=>$id]);
    });
});

#struktur organisasi
Route::get('struktur-organisasi', function () {
    return view('struktur-organisasi.grid');
});