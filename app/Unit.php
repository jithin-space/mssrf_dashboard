<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Unit extends Eloquent
{
    //

	public function variety(){

		return $this->belongsTo(Variety::class);
	}

	public function datapoint(){

		return $this->belongsTo(Datapoint::class);

	}

}
