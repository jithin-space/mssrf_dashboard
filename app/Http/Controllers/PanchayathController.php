<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanchayathController extends Controller
{
    //

    public function index(){

      $panchayath = \App\Panchayath::with('datapoints')->get();

      return view('Panchayath/index',['data'=>$panchayath]);
    }
}
