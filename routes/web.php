<?php

use App\Http\Controllers\DnsController;
use App\Http\Controllers\HomeControler;
use App\Http\Controllers\MtrController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\PingController;
use App\Http\Controllers\TracerouteController;
use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        



Route::controller(NetworkController::class)->group(function(){
    Route::get('/', 'index')->name('network.index');
    Route::post('/ping', 'ping')->name('network.ping');
    Route::post('/traceroute', 'traceroute')->name('network.traceroute');
    Route::post('/dnslookup', 'lookup')->name('network.lookup');
});

Route::controller(WebController::class)->group(function(){
    Route::get('/webtool', 'index')->name('web.index');
    Route::post('/webtool', 'post')->name('web.post');
});
