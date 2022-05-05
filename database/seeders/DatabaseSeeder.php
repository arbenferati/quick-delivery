<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Store;
use \App\Models\User;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Administrateur',
            'email' => 'admin@qd.com',
            'password' => Hash::make('password')
        ]);

        User::factory(5)->create();
        
        Role::create([
            'name' => 'admin'
        ]);

        Role::create([
            'name' => 'vendeur'
        ]);

        
        DB::table('user_has_role')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        for ($i=2; $i <= 6 ; $i++) { 
            Store::create([
                'name' => Str::random(10),
                'phone' => '+41 24 000 19 9' . $i,
                'address' => Str::random(13),
                'zip' => '180' . $i,
                'city' => Str::random(6),
                'user_id' => $i,
            ]);

            DB::table('user_has_role')->insert([
                'user_id' => $i,
                'role_id' => 2,
            ]);
        }

    }
}
