<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function show($id)
    {
        $order = new Order();
        $order = $order->getOrder($id);

        return view('orders.show', compact('order'));
    }
}
