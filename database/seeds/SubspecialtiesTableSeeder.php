<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SubspecialtiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('subspecialties')->insert([
                ['name' => 'Cantor(a)', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Cantor(a)'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Músico', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Músico'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Apresentador(a)', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Apresentador(a)'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Blogger/Youtuber', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Blogger/Youtuber'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Atleta', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Atleta'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'DJ', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('DJ'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Comediante', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Comediante'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Personalidade Pública', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Personalidade Pública'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Ator/Atriz', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Ator/Atriz'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Modelo', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Modelo'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Dançarino(a)', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Dançarino(a)'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Jornalista', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Jornalista'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Animador de Festa', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Animador de Festa'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Palhaço', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Palhaço'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Coral', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Coral'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Cia. de Teatro', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Cia. de Teatro'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Intérprete / Tradutor', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Intérprete / Tradutor'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Mestre de Cerimônias', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Mestre de Cerimônias'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Palestrante', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Palestrante'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],
                ['name' => 'Chef de Cozinha', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Chef de Cozinha'), 'status' => 1, 'specialty_id' => 1, 'user_id' => 1],

                ['name' => 'Limpeza', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Limpeza'), 'status' => 1, 'specialty_id' => 2, 'user_id' => 1],
                ['name' => 'Segurança', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Segurança'), 'status' => 1, 'specialty_id' => 2, 'user_id' => 1],
                ['name' => 'Cerimonial', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Cerimonial'), 'status' => 1, 'specialty_id' => 2, 'user_id' => 1],
                ['name' => 'Buffet', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Buffet'), 'status' => 1, 'specialty_id' => 2, 'user_id' => 1],
                ['name' => 'Decoração', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Decoração'), 'status' => 1, 'specialty_id' => 2, 'user_id' => 1],
                ['name' => 'Bebidas e Drinks', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Bebidas e Drinks'), 'status' => 1, 'specialty_id' => 2, 'user_id' => 1],
                ['name' => 'Foto e Vídeo', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Foto e Vídeo'), 'status' => 1, 'specialty_id' => 2, 'user_id' => 1],
                ['name' => 'Papelaria', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Papelaria'), 'status' => 1, 'specialty_id' => 2, 'user_id' => 1],
                ['name' => 'Estrutura', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Estrutura'), 'status' => 1, 'specialty_id' => 2, 'user_id' => 1],
                ['name' => 'Iluminação', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Iluminação'), 'status' => 1, 'specialty_id' => 2, 'user_id' => 1],
                ['name' => 'Aluguel de Roupas de Festa', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Aluguel de Roupas de Festa'), 'status' => 1, 'specialty_id' => 2, 'user_id' => 1],
                ['name' => 'Aluguel de Mesas e Cadeiras', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Aluguel de Mesas e Cadeiras'), 'status' => 1, 'specialty_id' => 2, 'user_id' => 1],
                ['name' => 'Aluguel de Carro e Motorista', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Aluguel de Carro e Motorista'), 'status' => 1, 'specialty_id' => 2, 'user_id' => 1],
                ['name' => 'Equipamento Sonoro e Audiovisual', 'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'slug' => Str::slug('Equipamento Sonoro e Audiovisual'), 'status' => 1, 'specialty_id' => 2, 'user_id' => 1]
            ]);
    }
}
