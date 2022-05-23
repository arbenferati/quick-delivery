<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class OrderController extends Controller
{
    public function show($id)
    {
        $order = new Order();
        $orderStatus = new OrderStatus();

        $order = $order->getOrder($id);
        $orderStatus = $orderStatus->getAllStatuses();

        return view('orders.show', compact('order', 'orderStatus'));
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

    public function update(Request $req)
    {
        $order = new Order();
        $order = $order->getOrder($req->order_id);
        $order->updateStatus($req->status_id);

        return Redirect()->back()->with('success', 'Le statut de la commande à été mis à jour');
    }
}
