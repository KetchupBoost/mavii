<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('event_categories')->insert([
                ['name' => 'Bar / Restaurante', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'status' => 1, 'slug' => Str::slug('Bar / Restaurante'), 'user_id' => 1],
                ['name' => 'Happy Hour / Churrasco', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'status' => 1, 'slug' => Str::slug('Happy Hour / Churrasco'), 'user_id' => 1],
                ['name' => 'Casamento / Formatura', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'status' => 1, 'slug' => Str::slug('Casamento / Formatura'), 'user_id' => 1],
                ['name' => 'Aniversário / 15 anos / Bar Mitzvá', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'status' => 1, 'slug' => Str::slug('Aniversário / 15 anos / Bar Mitzvá'), 'user_id' => 1],
                ['name' => 'Balada / Festa', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'status' => 1, 'slug' => Str::slug('Balada / Festa'), 'user_id' => 1],
                ['name' => 'Evento Público', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'status' => 1, 'slug' => Str::slug('Evento Público'), 'user_id' => 1],
                ['name' => 'Corporativo / Curso / Treinamento / Workshop', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'status' => 1, 'slug' => Str::slug('Corporativo / Curso / Treinamento / Workshop'), 'user_id' => 1],
                ['name' => 'Presença VIP', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'status' => 1, 'slug' => Str::slug('Presença VIP'), 'user_id' => 1],
                ['name' => 'Campanha Publicitária', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'status' => 1, 'slug' => Str::slug('Campanha Publicitária'), 'user_id' => 1],
                ['name' => 'Outros', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'status' => 1, 'slug' => Str::slug('Outros'), 'user_id' => 1]
            ]);
    }
}
