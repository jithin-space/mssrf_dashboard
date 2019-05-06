<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class HouseInfo extends Eloquent
{
    //
	public function family(){
		return $this->embedsOne(Family::class);
	}
	public function datapoint(){
		return $this->belongsTo(DataPoint::class);
	}
}
