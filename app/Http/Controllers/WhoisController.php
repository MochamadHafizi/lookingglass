<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhoisController extends Controller
{
    public function index(){
        return view('web.whois');
    }
    public function whois(Request $request)
    {   
        $request->validate([
            'requestUrl' => 'required',
        ]);

        $requestUrl = $request->input('requestUrl');
        $apiKey = '9879F9C725917DA8992F12F5F91EB7F3';

        $response = Http::withHeaders([
            "Content-Type" => "text/plain",
            "apikey" => $apiKey,
        ])->get("https://api.ip2whois.com/v2?key={$apiKey}&domain={$requestUrl}");

        $result = urldecode($response->body());
        $result = json_decode($result, true);

        return view('web.whois', compact('requestUrl', 'result'));
    }
}
