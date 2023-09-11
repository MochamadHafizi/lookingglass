<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TracerouteController extends Controller
{
    public function index(){
        return view('network.traceroute.traceview');
    }

    public function traceview6(){
        return view('network.traceroute.traceview6');
    }
    
    public function traceroute(Request $request)
    {
        $this->validate($request, [
            'domain' => 'required',
        ]);

        $domain = $request->input('domain');
        $outputrace = $this->executeTraceroute($domain);

        return view('network.traceroute.traceview', compact('domain', 'outputrace'));
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
            // dd($outputrace);
        }
    
        return implode("\n", $outputrace);
    }
    public function traceroute6(Request $request){
        $this->validate($request, [
            'domain' => 'required',
        ]);

        $domain = $request->input('domain');
        $outputrace6 = $this->executeTraceroute6($domain);

        return view('network.traceroute.traceview', compact('domain', 'outputrace6'));
    }
    private function executeTraceroute6($domain)
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $command = 'tracert -6 -w 500 ' . $domain;
        } else {
            $command = 'traceroute6 -m 30 ' . $domain;
        }
        
        exec($command, $outputrace, $returnCode);
        
        if ($returnCode !== 0) {
            // Handle the error or debug the issue
            // Uncomment the line below to view the error message in the browser
            // dd($outputrace);
        }
        
        return implode("\n", $outputrace);
    }
}
