<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
			'admin',
			'cliente',
			'profissional'
        ];

        foreach ($roles as $role) {
			Role::create(['name' => $role]);
        }

        $permissions = Permission::get();

        $role = Role::find(1);

        $role->syncPermissions($permissions);
    }
}
