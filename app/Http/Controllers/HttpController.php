<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HttpController extends Controller
{
    public function index(){
        return view('web.http');
    }
    public function httphc(Request $request){
        $requestUrl = $request->input('requestUrl');
        $data = array(
            "requestUrl" => $requestUrl
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://api.httpstatus.io/v1/status");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8'));

        $resulthttp = curl_exec($ch);
        // $httpStatusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);
        $hasilhttp = json_decode($resulthttp, true);
        
        return view('web.http', compact('hasilhttp'));
    }
}
