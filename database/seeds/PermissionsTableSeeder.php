<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
					'visualizar perfis de acesso',
					'criar perfil de acesso',
					'editar perfil de acesso',
					'apagar perfil de acesso',

					'editar informacoes basicas',

					'visualizar pagina',
          'criar pagina',
          'editar pagina',
          'apagar pagina',

					'criar especialidade',
					'editar especialidade',
					'apagar especialidade',

					'criar subespecialidade',
					'editar subespecialidade',
					'apagar subespecialidade',

					'criar categoria de eventos',
					'editar categoria de eventos',
					'apagar categoria de eventos',

					'visualizar evento',
					'editar evento',
					'apagar evento'
        ];

        foreach ($permissions as $permission) {
					Permission::create(['name' => $permission]);
        }
    }
}
