<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KepalaUptController extends Controller
{
        public function dashboard(){
        return view('kepala-upt.dashboard');
    }
}
