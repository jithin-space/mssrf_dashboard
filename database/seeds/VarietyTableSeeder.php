<?php

use Illuminate\Database\Seeder;
use \App\Crop;
use \App\Variety;

class VarietyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	DB::table('varieties')->delete();
        $json = File::get('database/data/data/varieties.json');
        $data = json_decode($json);

        foreach($data as $variety) {
                $crop =  Crop::where('name',$variety->crop)->first();
		if(!$crop){
			$crop = new \App\Crop;
			$crop->name = $variety->crop;
			$crop->eng = $variety->crop;
			$crop->mal = $variety->crop;
			$crop->save();
		}
                      $v_id =  DB::table('varieties')->insertGetId(array(

                                'name' => $variety->name,
                                'survey_id' => $variety->mal,
                                'eng' => $variety->eng,
                                'crop' => $variety->crop
                        ));
               $v= Variety::find($v_id);
		$crop->varieties()->save($v);
		
        }

    }
}
