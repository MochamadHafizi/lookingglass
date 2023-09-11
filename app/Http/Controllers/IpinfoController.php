<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IpinfoController extends Controller
{
    public function index(){
        return view('network.ipinfo.index');
    }

    public function ipinfo(Request $request)
    {
        $request->validate([
            'domain' => 'required',
        ]);
    
        $ip = $request->input('domain');
        // $key = '9879F9C725917DA8992F12F5F91EB7F3';
    
        $api_url = 'https://ipwho.is/' . $ip;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $api_url);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    
        $response = curl_exec($ch);
        curl_close($ch);
    
        $api_result = json_decode($response, true);
    
        return view('network.ipinfo.index', compact('api_result'));
    }
}
