<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;

class BrotliController extends Controller
{
    public function index(){
        return view('web.brotli');
    }
    public function brotli(Request $request){
        $url = $request->input('requestUrl');
         // Inisialisasi Guzzle HTTP client
         $client = new Client();

         // Tambahkan middleware untuk mencatat permintaan dan responsenya (opsional)
         $stack = HandlerStack::create();
         $stack->push(
             Middleware::log(
                 app('log'),
                 new MessageFormatter(MessageFormatter::DEBUG)
             )
         );
          // Konfigurasi client dengan middleware yang telah ditambahkan
        $client = new Client([
            'handler' => $stack,
        ]);
        try {
            // Kirim permintaan HTTP GET ke URL domain yang diberikan
            $response = $client->get($url);

            // Cek apakah responsenya menggunakan kompresi Brotli
            $isBrotliCompressed = $response->hasHeader('Content-Encoding')
                && $response->getHeader('Content-Encoding')[0] === 'br';
        } catch (\Exception $e) {
            // Jika terjadi error pada permintaan, tandai URL domain tidak menggunakan kompresi Brotli
            $isBrotliCompressed = false;
        }

        return view('web.brotli', compact('isBrotliCompressed'));
    }
}
