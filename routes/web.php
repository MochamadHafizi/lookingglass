<?php

use App\Http\Controllers\BrotliController;
use App\Http\Controllers\DnsController;
use App\Http\Controllers\HomeControler;
use App\Http\Controllers\HttpController;
use App\Http\Controllers\IpinfoController;
use App\Http\Controllers\MtrController;
use App\Http\Controllers\NetworkController;
use App\Http\Controllers\PingController;
use App\Http\Controllers\SpeedController;
use App\Http\Controllers\TracerouteController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\WebTestController;
use App\Http\Controllers\WhoisController;
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
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        



Route::controller(PingController::class)->group(function(){
    Route::get('/', 'index')->name('network.index');
    Route::post('/ping', 'ping')->name('network.ping');
    Route::get('/ping6view', 'ping6view')->name('network.ping6view');
    Route::post('/ping6', 'ping6')->name('network.ping6');
    // Route::post('/ipinfo', 'ipinfo')->name('network.ipinfo');
});

Route::controller(TracerouteController::class)->group(function(){
    Route::get('/traceview', 'index')->name('network.traceview');
    Route::post('/traceroute', 'traceroute')->name('network.traceroute');
    Route::get('/traceview6', 'traceview6')->name('network.traceview6');
    Route::post('/traceroute6', 'traceroute6')->name('network.traceroute6');
});

Route::controller(IpinfoController::class)->group(function(){
    Route::get('/ipinfoview', 'index')->name('network.ipinfoview');
    Route::post('/ipinfo', 'ipinfo')->name('network.ipinfo');
});


Route::controller(WebTestController::class)->group(function(){
    Route::get('/webspeed', 'index')->name('web.webspeedview');
    Route::post('/wst', 'webspeed')->name('web.webspeed');
});

Route::controller(WhoisController::class)->group(function(){
    Route::get('/whoisview', 'index')->name('web.whoisview');
    Route::post('/whois', 'whois')->name('web.whois');
});

Route::controller(DnsController::class)->group(function(){
    Route::get('/dnsview', 'index')->name('web.dnsview');
    Route::post('/dnslookup', 'lookup')->name('web.lookup');
});

Route::controller(BrotliController::class)->group(function(){
    Route::get('/brotliview', 'index')->name('web.brotliview');
    Route::post('/brotli', 'brotli')->name('web.brotli');
});

Route::controller(HttpController::class)->group(function(){
    Route::get('/httpview', 'index')->name('web.httpview');
    Route::post('/httphc', 'httphc')->name('web.httphc');
});

Route::controller(SpeedController::class)->group(function(){
    Route::get('/speed', 'index')->name('speed.index');
    Route::post('/speed/test', 'test')->name('speed.test');
});
