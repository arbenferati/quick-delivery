<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\Store;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = new Order();
        $store = Store::find(1);

        $data = array();

        foreach ($store->products as $p) {
            array_push($data, $p);
        }

        $order = $order->createOrder($data, 3, 1);
        $order->updateStatus(1);
        $order = $order->createOrder($data, 3, 1);
        $order->updateStatus(2);
        $order = $order->createOrder($data, 3, 1);
        $order->updateStatus(2);
        $order = $order->createOrder($data, 3, 1);
        $order->updateStatus(3);
        $order = $order->createOrder($data, 3, 1);
        $order->updateStatus(3);
        $order = $order->createOrder($data, 3, 1);
        $order->updateStatus(4);
    }
}
