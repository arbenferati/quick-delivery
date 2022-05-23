<?php

namespace Database\Seeders;

use App\Models\Role;
use \App\Models\User;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();

        // Creating admin [id:1]
        $user = $user->createUser(['name' => 'Eliot Alderson', 'email' => 'admin@qd.com', 'password' => 'password']);
        $role = Role::find(1);
        $role->assignToUser($user);

        // Creating a validated seller with a store [id:2]
        $user = $user->createUser(['name' => 'Sam Sepiol', 'email' => 'ss@qd.com', 'password' => 'password']);
        $user->validateUser();
        $role = Role::find(2);
        $role->assignToUser($user);

        // Creating a customer [id:3]
        $user = $user->createUser(['name' => 'Kelly Kapoor', 'email' => 'kk@qd.com', 'password' => 'password']);
        $role = Role::find(4);
        $role->assignToUser($user);

    }
}
