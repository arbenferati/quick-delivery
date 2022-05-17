<?php

namespace Database\Seeders;

use App\Models\Deliverer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Role;
use App\Models\Store;
use \App\Models\User;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $user = new User();
        $store = new Store();
        $order = new Order();
        $product = new Product();
        $deliverer = new Deliverer();

        /** Création de l'utilisateur admin avec le role admin */
            $user = $user->createUser(['name' => 'Administrateur', 'email' => 'admin@qd.com', 'password' => 'password']);
            $role = $role->createRole(['name' => 'admin']);
            $role->assignToUser($user);
        /** Fin création de l'utilisateur admin */

        /** Création de l'utilisateur vendeur avec le role vendeur ainsi que son magasin */
            $user = $user->createUser(['name' => 'Sam Sepiol', 'email' => 'ss@qd.com', 'password' => 'password']);
            $user->validateUser();
            $role = $role->createRole(['name' => 'vendeur']);
            $role->assignToUser($user);
            $store = $store->createStore(['store-name' => 'Mr. Robot store', 'phone' => '+41 24 000 00 00', 'address' => 'Rue qwerty 3', 'zip' => '1050', 'city' => 'NY', 'user_id' => $user->id], $user->id);
        /** Fin création de l'utilisateur vendeur avec le role vendeur  */

        /** Création de produits */
            $productData = array();
            for ($i=1; $i <= 5; $i++) {
                $product = $product->createProduct(['name' => 'Produit N°' . $i, 'store_id' => $store->id]);
                array_push($productData, $product);
            }
        /** Fin création de produits */

        /** Création de l'utilisateur client avec le role client et une commande*/
            $role = $role->createRole(['name' => 'client']);
            $user = $user->createCustomer(['name' => 'Client', 'email' => 'c@qd.com', 'password' => 'password']);
            $order = $order->createOrder($productData, $user->id, $store->id);
        /** Fin création de l'utilisateur client avec le role client */

        /** Création livreurs et le role livreur */
            $role = $role->createRole(['name' => 'livreur']);
            $deliverer = $deliverer->createDeliverer(['name' => 'Dwight Schrut', 'email' => 'ds@qd.com', 'password' => 'password'], $store);
            $deliverer = $deliverer->createDeliverer(['name' => 'Jim Helpert', 'email' => 'jh@qd.com', 'password' => 'password'], $store);
            $deliverer = $deliverer->createDeliverer(['name' => 'Pam Beesly', 'email' => 'bp@qd.com', 'password' => 'password']);
            $deliverer = $deliverer->createDeliverer(['name' => 'Andy Bernard', 'email' => 'ab@qd.com', 'password' => 'password']);
            $deliverer = $deliverer->createDeliverer(['name' => 'Stanley Hudson', 'email' => 'sh@qd.com', 'password' => 'password']);
            $store->askCollab($deliverer);
        /** Fin création livreurs et le role livreur */
    }
}
