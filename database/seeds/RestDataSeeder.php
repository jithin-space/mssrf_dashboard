<?php

use Illuminate\Database\Seeder;
class RestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

  $json1 = File::get('database/data/input.json');



  $data1 = json_decode($json1);

  // $dataAll = array_merge($data,$data)
	foreach($data1 as $panchayath) {
		array_chunk($panchayath,1);
    echo "hello";

		foreach($panchayath as $dp){
      $pname = (strtolower($dp->panchayath)=== 'thondernadu')?'thondarnadu':$dp->panchayath;
			$pt = \App\Panchayath::where('name', strtolower($pname))->first();
			if(!$pt){
				$pt = new \App\Panchayath;
				$pt->name = strtolower($dp->panchayath);
				$pt->eng = $pt->name;
				$pt->mal = $pt->name;
        $pt->save();
			}

			$houseInfo = new \App\HouseInfo;
			$houseInfo->panchayath = $dp->panchayath;
			$houseInfo->wardNumber = $dp->ward_number;
			$houseInfo->village = $dp->village;
			$houseInfo->houseNumber = $dp->house_number;
			$houseInfo->category = $dp->category;
			$houseInfo->ownLand = $dp->own_land;
			$houseInfo->save();

			$f=$dp->family;

			$family = new \App\Family;
			$family->nadha = $f->kudumbanadhi;
			$family->nadhan = $f->kudumbanadhan;
			$family->men = $f->men_count;
			$family->women = $f->women_count;
			$family->child = $f->children_count;
			$family->total = $f->total_members;
			$family->phone = $f->contact->phone;
			$family->address = $f->contact->address;

			$houseInfo->family()->save($family);

			$dataPoint = new \App\DataPoint;
			$dataPoint->geolocation = $dp->geolocation;
			$dataPoint->surveyId = $dp->survey_id;
			$dataPoint->surveyorName = isset($dp->surveyor_name)?$dp->surveyor_name:'not-found';
			$dataPoint->pt = $dp->panchayath;
			$dataPoint->save();

      $pt->datapoints()->save($dataPoint);

			$dataPoint->houseInfo()->save($houseInfo);
if(!isset($dp->crops)){
	continue;
}
			$cr = $dp->crops;
			foreach($cr as $key=>$value){
				$crObj = \App\Crop::where('name',$key)->first();
				if(!$crObj){
					$crObj = new \App\Crop;
					$crObj->name = $key;
					$crObj->eng = $key;
					$crObj->mal = $key;
					$crObj->save();
				}

				$dataPoint->crops()->save($crObj);

				if(!isset($value->varieties)){
				 continue;
				}
				foreach($value->varieties as $vname=>$vvalue){

					$vname = (strtolower($vname)=='bamblimaas')?'bamblimoos':$vname;
					$vrObj = \App\Variety::whereHas('crop',function($query) use(&$key){
						$query->where('name',$key);
					})->where('name',$vname)->first();

					if(!$vrObj){
						print('not-found');
						$vrObj = new \App\Variety;
						$vrObj->name = $vname;
						$vrObj->eng = $vname;
						$vrObj->mal = $vname;
						$vrObj->save();
						$crObj->varieties()->save($vrObj);
					}

					$unit = new \App\Unit;
					$unit->bhoomi = $vvalue->bhoomi;
					$unit->ennam = $vvalue->ennam;
					$unit->land = $vvalue->land;
					$unit->loss = $vvalue->loss;
					$unit->overcome = $vvalue->overcome;
					$unit->years = $vvalue->years;
          $unit->geo = $dataPoint->geolocation;
          $unit->pt = $dataPoint->pt;
					$unit->save();
					$vrObj->units()->save($unit);
          $unit->datapoint()->associate($dataPoint);
					$dataPoint->units()->save($unit);


				}
			}

		}
	}
    }
}
