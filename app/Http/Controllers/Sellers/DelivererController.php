<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Models\Deliverer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DelivererController extends Controller
{
    /**
     * This will return the deliverer management page
     */
    public function index()
    {
        $store = Auth::user()->store;
        $storeDeliverers = $store->deliverers;

        return view('deliverers.index', compact('storeDeliverers'));
    }


    /**
     * This will add a user as deliverer
     */
    public function addDeliverer(Request $req)
    {
        $data = array();
        $store = Auth::user()->store;
        $deliverer = new Deliverer();

        $data = [
            'name' => $req->name,
            'email' => $req->email,
            'password' => Str::random(15)
        ];

        $deliverer = $deliverer->createDeliverer($data, $store);

        return Redirect()->route('index-deliverers')->with('success', 'Vous venez d\'engager "' . $deliverer->name . '". Félicitation.');
    }
}
