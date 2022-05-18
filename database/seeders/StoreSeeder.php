<?php

namespace Database\Seeders;

use App\Models\Store;

use Illuminate\Database\Seeder;

class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $store = new Store();
        $store = $store->createStore([
                    'store-name' => 'Mr. Robot store',
                    'phone' => '+41 24 000 00 00',
                    'address' => 'Rue qwerty 3',
                    'zip' => '1050',
                    'city' => 'NY'
                ], 2);

    }
}
