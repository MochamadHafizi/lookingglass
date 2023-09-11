<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;


class WebController extends Controller
{
    // public function index(){
    //     $domain = '';
    //     $result = null;
    //     // $isBrotliCompressed = null;

    //     return view('web.main', compact('domain', 'result'));
    // }

   
   

   
    
    
    // public function webspeed(Request $request){
    //     $request->validate([
    //         'requestUrl' => 'required',
    //     ]);
    
    //     $url = $request->input('requestUrl');
    //     $apiKey = 'AIzaSyBz-3djDWPF8o5uhdkTedftkuEt4tlK3Os';
    
    //     $apiUrl = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url={$url}&key={$apiKey}";
    
    //     try {
    //         $response = Http::get($apiUrl);
    
    //         if ($response->successful()) {
    //             $pageSpeedData = $response->json();
    //             return view('web.main', compact('pageSpeedData'));
    //         } else {
    //             return "Error: " . $response->status();
    //         }
    //     } catch (\Exception $e) {
    //         return "Error: " . $e->getMessage();
    //     }
    // }
    
}
