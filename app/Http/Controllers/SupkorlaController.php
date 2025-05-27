<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupkorlaController extends Controller
{
        public function dashboard(){
        return view('supkorla.dashboard');
    }
}
