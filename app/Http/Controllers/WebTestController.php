<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class WebTestController extends Controller
{
    public function index(){
        return view('web.webtest');
    }

    public function webspeed(Request $request){
        $request->validate([
            'requestUrl' => 'required',
        ]);
    
        $url = $request->input('requestUrl');
        $apiKey = 'AIzaSyBz-3djDWPF8o5uhdkTedftkuEt4tlK3Os';
    
        $apiUrl = "https://www.googleapis.com/pagespeedonline/v5/runPagespeed?url={$url}&key={$apiKey}";
    
        try {
            $response = Http::get($apiUrl);
    
            if ($response->successful()) {
                $pageSpeedData = $response->json();
                return view('web.webtest', compact('pageSpeedData'));
            } else {
                return "Error: " . $response->status();
            }
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
}
