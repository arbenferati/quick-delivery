<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'store_id',
        'order_status_id'
    ];


    public function getOrder(int $id)
    {
        return $this::findOrFail($id);
    }

    public function attachProductToOrder(Order $order, Product $product)
    {
        return DB::table('order_has_product')->insert(['product_id' => $product->id, 'order_id' => $order->id]);
    }

    public function createOrder(array $products, int $customerId, int $storeId)
    {
        $order = $this::create(['customer_id' => $customerId, 'store_id' => $storeId]);

        foreach ($products as $product) {
            $result = $this->attachProductToOrder($order, $product);
        }

        return $order;
    }

    public function updateStatus(int $status_id)
    {
        $this->order_status_id = $status_id;
        $this->save();
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_has_product');
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'id');
    }

}
