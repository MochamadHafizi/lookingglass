<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SpeedTest\Runner;
use Illuminate\Support\Facades\Http;

class SpeedController extends Controller
{
    public function index(){
        return view('speed.main');
    }
}
