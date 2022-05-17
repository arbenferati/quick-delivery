<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

class Deliverer extends User
{
    protected $table = 'users';

    /**
     * Will get or fail a user of type deliverer
     */
    public function getDeliverer($id)
    {
        return $this->findOrFail($id);
    }

    /**
     * Will get all users of type 'livreur'
     */
    public function getDeliverers()
    {
        $role = new Role();
        $role = $role->getRoleByName('livreur');

        return $role->users;
    }

    /**
     * This will create a user and assign the 'client' role to him
     * @param array $data : It needs a 'name', an 'email' and a 'password'
     * @param Store $store : Optional, if is set, that means that it's the store adding the user so we confirm
     *                       the collaboration
     */
    public function createDeliverer(array $data, Store $store = null)
    {
        $role = new Role();
        $role = $role->getRoleByName('livreur');
        $deliverer = $this->createUser($data);
        $role->assignToUser($deliverer);

        if ($store != null) {
            $store->askCollab($deliverer);
            $deliverer->acceptCollab($store);
        }

        return $deliverer;
    }

    /**
     * Will check if the user has confirmed the collaboration with the store
     */
    public function confirmed(Deliverer $deliverer, Store $store)
    {
        $result = DB::select('select user_confirmed from store_has_deliverer where user_id = ' . $deliverer->id . ' and store_id = ' . $store->id);

        if ($result[0]->user_confirmed == null) {
            return false;
        }

        return true;
    }

    /**
     * Will create a relation but without the store confirmation
     */
    public function askCollab(Store $store)
    {
        DB::insert('insert into store_has_deliverer (user_id, store_id, user_confirmed, created_at) values (?, ?, ?, ?)', [
            $this->id,
            $store->id,
            now(),
            now(),
        ]);
    }

    /**
     * Will confirm the collaboration with the store
     */
    public function acceptCollab(Store $store)
    {
        DB::table('store_has_deliverer')->where('user_id', $this->id)->where('store_id', $store->id)->update([
            'user_confirmed' => now(),
        ]);
    }

}
