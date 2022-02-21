<?php

use Illuminate\Database\Seeder;

class InfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
			DB::table('info')->insert([
                ['email1' => 'contato@thaismirandola.com.br', 'phone1' => '6530544457 ', 'cellphone1' => '65984544457 ', 'address' => 'Av. Carmindo de Campos, 146, Jardim Petropolis, Centro Carmindo da Construção - Sala 15 - CEP 78070-100 - Cuiabá/MT', 'user_id' => 1]
            ]);
    }
}
