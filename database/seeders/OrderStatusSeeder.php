<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = new OrderStatus();

        $status = $status->createStatus('Nouveau');
        $status = $status->createStatus('En préparation');
        $status = $status->createStatus('Prête');
        $status = $status->createStatus('Annulée');
    }
}
