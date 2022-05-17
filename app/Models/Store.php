<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address',
        'zip',
        'city',
        'user_id'
    ];

    public function createStore(array $data, $user_id)
    {
        return $this::create([
            'name' => $data['store-name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'zip' => $data['zip'],
            'city' => $data['city'],
            'user_id' => $user_id,
        ]);
    }

    public function destroyStore()
    {
        $this->forceDelete();
    }



    public function askCollab(Deliverer $deliverer)
    {
        DB::insert('insert into store_has_deliverer (user_id, store_id, store_confirmed, created_at) values (?, ?, ?, ?)', [
            $deliverer->id,
            $this->id,
            now(),
            now(),
        ]);
    }

    public function acceptCollab(Deliverer $deliverer)
    {
        DB::table('store_has_deliverer')->where('user_id', $deliverer->id)->where('store_id', $this->id)->update([
            'store_confirmed' => now(),
        ]);
    }

    public function destroyCollab(Deliverer $deliverer)
    {
        DB::table('store_has_deliverer')->where('user_id', $deliverer->id)->where('store_id', $this->id)->delete();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    /**
     * Will return a list of products related to the store
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function trashedProducts()
    {
        return $this->hasMany(Product::class)->onlyTrashed();
    }

    /**
     * Will get the deliverers working for the store
     */
    public function deliverers()
    {
        return $this->belongsToMany(Deliverer::class, 'store_has_deliverer', 'store_id', 'user_id');
    }
}
