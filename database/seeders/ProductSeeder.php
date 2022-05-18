<?php

namespace Database\Seeders;

use App\Models\Product;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product();

        for ($i=1; $i <= 5; $i++) {
            $product = $product->createProduct(['name' => 'Produit N°' . $i, 'store_id' => 1]);
        }

    }
}
