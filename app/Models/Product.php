<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'store_id',
    ];

    protected $table = 'products';

    public function createProduct(array $data)
    {
        if (Auth::user()) {
            return $this::create([
                'name' => $data['name'],
                'store_id' => auth()->user()->store->id,
            ]);
        }

        return $this::create([
            'name' => $data['name'],
            'store_id' => $data['store_id'],
        ]);

    }

    public function editProduct(array $data)
    {
        if (Auth::user()) {
            $this->update([
                'name' => $data['name'],
                'store_id' => Auth::user()->store->id,
            ]);
        } else {
            $this->update([
                'name' => $data['name'],
                'store_id' => $data['store_id'],
            ]);
        }

        $this->save();

        return $this;
    }

    public function deleteProduct()
    {
        $this->delete();
    }

    public function restoreProduct()
    {
        $this->restore();
    }

    public function getProduct(int $id)
    {
        return $this::withTrashed()->findOrFail($id);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_has_product');
    }
}
