<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DnsController extends Controller
{
    public function index(){
        return view('web.dnslookup');
    }
    public function lookup(Request $request)
    {
        $request->validate([
            'requestUrl' => 'required',
        ]);

        $domain = $request->input('requestUrl');
        $apiKey = 'dfzB0ZAMy5j3bXyVFTYNfQ==c1edtYMiexaPyGb2';

        $response = Http::withHeaders([
            'X-Api-Key' => $apiKey,
        ])->get('https://api.api-ninjas.com/v1/dnslookup', [
            'domain' => $domain,    
        ]);

        $resultdns = urldecode($response->body());
        $resultdns = json_decode($resultdns, true);

        return view('web.dnslookup', compact('domain', 'resultdns'));
    }
}
