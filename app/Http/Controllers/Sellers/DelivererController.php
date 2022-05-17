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
        $deliverer = new Deliverer();

        $storeDeliverers = $store->deliverers;
        $allDeliverers = $deliverer->getDeliverers();

        foreach ($storeDeliverers as $deliverer) {
            foreach ($allDeliverers as $key => $d) {
                if ($deliverer->id == $d->id) {
                    unset($allDeliverers[$key]);
                }
            }
        }

        return view('deliverers.index', compact('storeDeliverers', 'allDeliverers'));
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


    /**
     * This will handel a store request to work with a deliverer
     */
    public function requestToDeliverer(Request $req)
    {
        $deliverer = new Deliverer();
        $store = Auth::user()->store;

        $deliverer = $deliverer->getDeliverer($req->deliverer_id);

        $store->askCollab($deliverer);

        return Redirect()->route('index-deliverers')->with('success', 'La demande de collaboration avec "' . $deliverer->name . '" a été effectué avec succès.');
    }



    public function stopCollaborationWithDeliverer($id)
    {
        $deliverer = new Deliverer();
        $store = Auth::user()->store;

        $deliverer = $deliverer->getDeliverer($id);

        $store->destroyCollab($deliverer);

        return Redirect()->route('index-deliverers')->with('success', 'La demande d\'arrêt de collaboration avec "' . $deliverer->name . '" a été effectué avec succès.');
    }


    public function cancelRequestDeliverer($id)
    {
        $deliverer = new Deliverer();
        $deliverer = $deliverer->getDeliverer($id);

        $store = Auth::user()->store;
        $store->destroyCollab($deliverer);

        return Redirect()->route('index-deliverers')->with('success', 'Vous venez annuler la requête de collaboration avec "' . $deliverer->name . '".');
    }
}
