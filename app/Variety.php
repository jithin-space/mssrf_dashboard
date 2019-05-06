<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
class Variety extends Eloquent
{
    //
	public function units(){
		return $this->hasMany(Unit::class);
	}
	public function crop(){
		return $this->belongsTo(Crop::class);
	}
}
