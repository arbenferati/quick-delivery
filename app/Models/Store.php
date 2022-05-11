<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
