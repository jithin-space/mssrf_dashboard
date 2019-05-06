<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Crop extends Eloquent
{
    //
	protected $fillable = ['name','eng','mal'];

	public function datapoints(){
		return $this->belongsToMany(DataPoint::class, null, 'data_point_ids', 'crop_ids');
	}
	public function varieties(){

		return $this->hasMany(Variety::class);
	}
}
