<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class WebController extends Controller
{
    public function index(){
        $domain = '';
        $result = null;

        return view('web.main', compact('domain', 'result'));
    }

    public function post(Request $request)
    {   
        $request->validate([
            'domain' => 'required',
        ]);

        $domain = $request->input('domain');
        $apiKey = '9879F9C725917DA8992F12F5F91EB7F3';

        $response = Http::withHeaders([
            "Content-Type" => "text/plain",
            "apikey" => $apiKey,
        ])->get("https://api.ip2whois.com/v2?key={$apiKey}&domain={$domain}");

        $result = urldecode($response->body());
        $result = json_decode($result, true);

        return view('web.main', compact('domain', 'result'));
    }
    
}
