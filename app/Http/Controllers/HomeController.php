<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function index(){
      $data = array('datapoints'=>\App\DataPoint::count(),'crops'=>\App\Crop::count(),'varieties'=>\App\Variety::count());
      return view('home',['data' => $data]);
    }
}
