<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HttpController extends Controller
{
    public function index(){
        return view('web.http');
    }
    public function httphc(Request $request){
        $requestUrl = $request->input('requestUrl');
    
        $client = new \GuzzleHttp\Client();
    
        $headers = [
            'x-api-key' => '9526cc30-7e83-4ccc-bc88-d514b68a3220',
            'Content-Type' => 'application/json',
        ];
    
        $body = json_encode([
            'url' => $requestUrl,
            'proxyCountry' => 'us',
            'followRedirect' => true,
        ]);
    
        $response = $client->post('https://api.siterelic.com/httpheader', [
            'headers' => $headers,
            'body' => $body,
        ]);
    
        $result = $response->getBody()->getContents();
    
        // dd($result);
         // Mengurai respons sebagai JSON
        $resultArray = json_decode($result, true);
        return view('web.http', compact('resultArray'));
    }
}
