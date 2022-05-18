<?php

namespace Database\Seeders;

use App\Models\Deliverer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Store;

class DelivererSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $deliverer = new Deliverer();
        $store = Store::find(1);

        $deliverer = $deliverer->createDeliverer(['name' => 'Dwight Schrut', 'email' => 'ds@qd.com', 'password' => 'password'], $store);
        $deliverer = $deliverer->createDeliverer(['name' => 'Jim Helpert', 'email' => 'jh@qd.com', 'password' => 'password'], $store);
        $deliverer = $deliverer->createDeliverer(['name' => 'Pam Beesly', 'email' => 'bp@qd.com', 'password' => 'password']);
        $deliverer = $deliverer->createDeliverer(['name' => 'Andy Bernard', 'email' => 'ab@qd.com', 'password' => 'password']);
        $deliverer = $deliverer->createDeliverer(['name' => 'Stanley Hudson', 'email' => 'sh@qd.com', 'password' => 'password']);

    }
}
