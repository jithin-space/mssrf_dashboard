<?php

use Illuminate\Database\Seeder;

class CropTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	DB::table('crops')->delete();
        $json = File::get('database/data/data/crops.json');
        $data = json_decode($json);

        foreach($data as $crop) {

                        DB::table('crops')->insert(array(

                                'name' => $crop->name,
                                'eng' => $crop->eng,
                                'mal' => $crop->mal
			));  
        }

    }
}
