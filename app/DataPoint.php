<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class DataPoint extends Eloquent
{

    //
	public function panchayath(){
		return $this->belongsTo(Panchayath::class);
	}

	public function crops(){
		return $this->belongsToMany(Crop::class);
	}

	public function units(){
		return $this->hasMany(Unit::class);
	}

	public function houseInfo(){
		return $this->hasOne(HouseInfo::class);
	}
	
}
