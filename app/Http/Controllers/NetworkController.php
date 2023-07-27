<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Client;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class NetworkController extends Controller
{
    public function index(){
        return view('network.main');
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

            // Fungsi untuk melakukan ping ke domain menggunakan fsockopen
            function pingDomain($domain) {
                $pingTime = array();
                $ipAddresses = array();
                $maxAttempts = 4;
                $timeout = 1; // Timeout dalam detik

                for ($i = 0; $i < $maxAttempts; $i++) {
                    $startTime = microtime(true);
                    $filePointer = @fsockopen($domain, 80, $errorNumber, $errorMessage, $timeout);
                    $endTime = microtime(true);

                    if ($filePointer) {
                        fclose($filePointer);
                        $pingTime[] = round(($endTime - $startTime) * 1000, 2); // Waktu ping dalam milidetik
                        $ipAddresses[] = gethostbyname($domain); // Mendapatkan alamat IP dari domain
                    } else {
                        $pingTime[] = '*'; // Menandakan koneksi gagal
                        $ipAddresses[] = 'N/A'; // Menandakan alamat IP tidak dapat ditemukan
                    }
                }

                return ['pingTime' => $pingTime, 'ipAddresses' => $ipAddresses];
            }

            $pingResults = pingDomain($domain);

            // Tampilkan hasil ping dan alamat IP seperti di cmd
            $output = "Ping ke $domain:\n";
            $output .= "----------------------------------------\n";

            for ($i = 0; $i < count($pingResults['pingTime']); $i++) {
                $output .= "Attempt " . ($i + 1) . ": " . $pingResults['pingTime'][$i] . " ms\tIP Address: " . $pingResults['ipAddresses'][$i] . "\n";
            }

            return view('network.main', compact('output'));
        }

        return view('network.main');
    }


    public function traceroute(Request $request)
    {
        $this->validate($request, [
            'domain' => 'required',
        ]);

        $domain = $request->input('domain');
        $outputrace = $this->executeTraceroute($domain);

        return view('network.main', compact('domain', 'outputrace'));
    }
    private function executeTraceroute($domain)
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $command = 'tracert '.$domain;
        } else {
            $command = 'traceroute '.$domain;
        }
    
        exec($command, $outputrace, $returnCode);
    
        if ($returnCode !== 0) {
            // Handle the error or debug the issue
            // Uncomment the line below to view the error message in the browser
            dd($outputrace);
        }
    
        return implode("\n", $outputrace);
    }

    public function lookup(Request $request)
    {
        $request->validate([
            'domain' => 'required',
        ]);

        $domain = $request->input('domain');
        $apiKey = 'dfzB0ZAMy5j3bXyVFTYNfQ==c1edtYMiexaPyGb2';

        $response = Http::withHeaders([
            'X-Api-Key' => $apiKey,
        ])->get('https://api.api-ninjas.com/v1/dnslookup', [
            'domain' => $domain,
        ]);

        $resultdns = urldecode($response->body());
        $resultdns = json_decode($resultdns, true);

        return view('network.main', compact('domain', 'resultdns'));
    }

    // private function dnsLookup($domain)
    // {
    //     $ipAddresses = array();

    //     $dnsRecords = dns_get_record($domain, DNS_ANY);

    //     foreach ($dnsRecords as $record) {
    //         $type = isset($record['type']) ? $record['type'] : 'Unknown Type';
    //         if (isset($record['ip'])) {
    //             $ipAddresses[$type][] = $record['ip'];
    //         } elseif (isset($record['target'])) {
    //             $ipAddresses[$type][] = $record['target'];
    //         }
    //     }

    //     return $ipAddresses;
    // }
        
}
