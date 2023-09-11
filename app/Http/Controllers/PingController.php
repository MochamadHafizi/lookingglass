<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PingController extends Controller
{
    public function index(){
        return view('network.ping.ping4');
    }
    public function ping6view(){
        return view('network.ping.ping6');
    }

    public function ping(Request $request)
{
    if ($request->isMethod('post')) {
        $validator = Validator::make($request->all(), [
            'domain' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $domain = $request->input('domain');

        function pingDomain($domain) {
            $pingResults = [];

            $maxAttempts = 4;
            $timeout = 1; // Timeout dalam detik

            for ($i = 0; $i < $maxAttempts; $i++) {
                $startTime = microtime(true);
                $filePointer = @fsockopen($domain, 80, $errorNumber, $errorMessage, $timeout);
                $endTime = microtime(true);

                if ($filePointer) {
                    fclose($filePointer);
                    $pingTime = round(($endTime - $startTime) * 1000, 2); // Waktu ping dalam milidetik
                    $ipAddress = gethostbyname($domain); // Mendapatkan alamat IP dari domain
                } else {
                    $pingTime = '*'; // Menandakan koneksi gagal
                    $ipAddress = 'N/A'; // Menandakan alamat IP tidak dapat ditemukan
                }

                $pingResults[] = [
                    'attempt' => ($i + 1),
                    'pingTime' => $pingTime,
                    'ipAddress' => $ipAddress,
                ];
            }

            return $pingResults;
        }

        $pingResults = pingDomain($domain);

        return view('network.ping.ping4', compact('pingResults'));
    }

    return view('network.ping.ping4');
}
    

    public function ping6(Request $request)
    {
        $request->validate([
            'domain' => 'required',
        ]);

        $domain = $request->input('domain');
        $result = $this->executePing6($domain);

        return view('network.ping.ping6', compact('domain', 'result'));
    }

    private function executePing6($domain)
    {
        $command = "ping -6 -c 4 $domain"; // Linux command

        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $command = "ping -6 -c 4 $domain"; // Windows command
        }

        // Pengecekan apakah shell_exec() diaktifkan
        if (!function_exists('shell_exec')) {
            return "Error: Shell execution is disabled.";
        }

        try {
            // Eksekusi perintah dan tangkap hasilnya
            $result = shell_exec($command);

            if ($result === null) {
                // Perintah gagal dieksekusi
                return "Error: Failed to execute ping6 command. Check error logs for details.";
            }

            return $result;
        } catch (\Exception $e) {
            return "Error: " . $e->getMessage();
        }
    }
 
    
        
}
