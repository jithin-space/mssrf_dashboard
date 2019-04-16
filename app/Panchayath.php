<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Panchayath extends Eloquent
{
    //
	protected $fillable= ['name','mal','eng'];

	public function datapoints(){
		return $this->hasMany(DataPoint::class);
	}
}
