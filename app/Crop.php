<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Crop extends Eloquent
{
    //
	protected $fillable = ['name','eng','mal'];

	public function datapoints(){
		return $this->hasMany(DataPoint::class);
	}
	public function varieties(){

		return $this->hasMany(Variety::class);
	}
}
