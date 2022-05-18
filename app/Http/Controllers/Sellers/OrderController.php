<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function show($id)
    {
        $order = new Order();
        $order = $order->getOrder($id);

        return view('orders.show', compact('order'));
    }

    public function cancelOrder($id)
    {
        $order = new Order();
        $order = $order->getOrder($id);

        $order->updateStatus(4);

        return Redirect()->home()->with('success', 'La commande à bien été annulée');
    }

    public function updateStatus($order_id, $status_id)
    {
        $order = new Order();
        $order = $order->getOrder($order_id);
        $order->updateStatus($status_id);

        return Redirect()->home()->with('success', 'Le statut de la commande à été mis à jour');
    }
}
