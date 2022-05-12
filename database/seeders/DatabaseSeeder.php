<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Product;
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

        $user = User::create([
            'name' => 'Sam Sepiol',
            'email' => 'ss@qd.com',
            'password' => Hash::make('password')
        ]);

        $user->validated_at = now();
        $user->save();

        $user = null;

        User::create([
            'name' => 'Client',
            'email' => 'c@qd.com',
            'password' => Hash::make('password')
        ]);

        User::factory(2)->create();

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'vendeur']);
        Role::create(['name' => 'client']);


        DB::table('user_has_role')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);

        DB::table('user_has_role')->insert([
            'user_id' => 2,
            'role_id' => 2,
        ]);

        DB::table('user_has_role')->insert([
            'user_id' => 3,
            'role_id' => 3,
        ]);

        $store = Store::create([
            'name' => 'Mr. Robot store',
            'phone' => '+41 24 000 00 00',
            'address' => 'Rue qwerty 3',
            'zip' => '1050',
            'city' => 'NY',
            'user_id' => 2,
        ]);

        $productData = array();

        for ($i=1; $i < 11; $i++) {
            $product = Product::create(['name' => 'Produit N°' . $i, 'store_id' => $store->id]);
            array_push($productData, $product);
        }

        $order = new Order();
        $order = $order->createOrder($productData, 3, $store->id);


        for ($i=4; $i <= 5 ; $i++) {
            $store = Store::create([
                'name' => Str::random(10),
                'phone' => '+41 24 000 19 9' . $i,
                'address' => Str::random(13),
                'zip' => '180' . $i,
                'city' => Str::random(6),
                'user_id' => $i,
            ]);

            for ($j=4; $j <= 5; $j++) {
                Product::create(['name' => 'Produit N°' . $j - 3, 'store_id' => $store->id]);
            }

            DB::table('user_has_role')->insert([ 'user_id' => $i, 'role_id' => 2, ]);

        }

    }
}
