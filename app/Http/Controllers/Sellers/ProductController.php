<?php

namespace App\Http\Controllers\Sellers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addProduct(Request $request)
    {
        $product = new Product();
        $product = $product->createProduct($request->toArray());
        $product->save();

        return redirect()->back()->with('success', 'Le produit "' . $product->name . '" a été créer avec succès');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editProduct(Request $request, $id)
    {
        try {
            $product = new Product();
            $product = $product->getProduct($id);
            $product = $product->editProduct($request->toArray());

            return redirect()->back()->with('success', 'Le produit "' . $product->name . '" a été modifié avec succès');
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct($id)
    {
        $product = new Product();
        $product = $product->getProduct($id);
        $product->deleteProduct();

        return redirect()->back()->with('success', 'Le produit "' . $product->name . '" a bien été supprimé.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restoreProduct($id)
    {
        $product = new Product();
        $product = $product->getProduct($id);
        $product->restoreProduct();

        return redirect()->back()->with('success', 'Le produit "' . $product->name . '" a bien été restauré.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deletedProducts()
    {
        $products = auth()->user()->store->trashedProducts;

        return view('sellers.products.deleted.index', compact('products'));
    }
}
