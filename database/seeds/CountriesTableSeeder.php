<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('countries')->insert([
				'name' => 'Brazil',
                'pt_name' => 'Brasil',
                'abbreviation' => 'BR',
                'bacen' => 1058,
			]);
    }
}
