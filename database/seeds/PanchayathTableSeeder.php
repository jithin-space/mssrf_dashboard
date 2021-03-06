<?php

use Illuminate\Database\Seeder;

class PanchayathTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
	DB::table('panchayaths')->delete();
        $json = File::get('database/data/data/panchayath.json');
        $data = json_decode($json);

        foreach($data as $panchayath) {

		DB::table('panchayaths')->insert(array(
			'name' => $panchayath->name,
			'eng' => $panchayath->eng,
			'mal' => $panchayath->mal
			));
        }

    }
}
