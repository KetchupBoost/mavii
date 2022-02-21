<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('specialties')->insert([
                ['name' => 'Artista', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'icon' => 'fas fa-music', 'slug' => Str::slug('Artista'), 'user_id' => 1],
                ['name' => 'Prestador de Serviço', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'icon' => 'fas fa-tools', 'slug' => Str::slug('Prestador de Serviço'), 'user_id' => 1]
            ]);
    }
}
