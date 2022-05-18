<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role = $role->createRole(['name' => 'admin']);
        $role = $role->createRole(['name' => 'vendeur']);
        $role = $role->createRole(['name' => 'livreur']);
        $role = $role->createRole(['name' => 'client']);
    }
}
