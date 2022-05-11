<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
        return $this::create([
            'name' => $data['name'],
            'store_id' => auth()->user()->store->id,
        ]);
    }

    public function editProduct(array $data)
    {
        $this->update([
            'name' => $data['name'],
            'store_id' => auth()->user()->store->id,
        ]);

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
}
