<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {

        $products = Product::paginate(5);
        return view('welcome', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, $id)
    {
        $addToBasket = $request->all();
        $product = Product::findOrFail($id);
        $basket = session('basket.products');

        if (!$basket) {

            $basket = [
                [
                    "id" => $id,
                    "product" => $product,
                    "quantity" => $addToBasket['quantity'],
                    "size" => $addToBasket['size'],
                    "color" => $addToBasket['color']
                ]
            ];
            session()->put('basket.products', $basket);

            return redirect()->back()->with('success', 'Product added to basket successfully!');
        }
        foreach ($basket as $index => $item) {
            if($item['id'] === $id && $item['size'] === $addToBasket['size']){

            $basket[$index]['quantity'] += $addToBasket['quantity'];

            session()->put('basket.products', $basket);

            return redirect()->back()->with('success', 'Product added to basket successfully!');
            }
        }
        array_push($basket, [
            "id" => $id,
            "product" => $product,
            "quantity" => $addToBasket['quantity'],
            "size" => $addToBasket['size'],
            "color" => $addToBasket['color']
        ]);

        session()->put('basket.products', $basket);

        return redirect()->back()->with('success', 'Product added to basket successfully!');
    }
    /**
     * Display the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Product $product, $id)
    {
        return view('product', ['product' => $product->findOrFail($id)]);
    }


    public function showBasket()
    {
        $count = 0;
        $basket = session('basket.products');

        if(!empty($basket))
        foreach ($basket as $index => $product) {
            $count += $product['product']->price* $product['quantity'];
        }


        session()->put('total', $count);
        return view('basket', ['basket' => $basket, 'total' => $count]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $addToBasket = $request->all();
        $basket = session('basket.products');

        foreach ($basket as $index => $item) {
            if($item['id'] === $id ){

                $basket[$index]['quantity'] = $addToBasket['quantity'];

                session()->put('basket.products', $basket);
                return redirect()->back()->with('success', 'Product quantity changed successfully!');
            }
        }

        return redirect()->back()->with('error', 'Product quantity not changed !');
    }

    public function deleteIntoBasket(Request $request,$id) {
        session()->forget('basket.products.'.$id);
        return redirect()->back()->with('success', 'Product removed from basket successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
