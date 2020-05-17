<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Mail\AdminMail;
use App\Mail\MailtrapExample;
use App\Order;
use App\Product;
use Illuminate\Bus\Queueable;

use App\OrderInfo;
use App\Orders_products;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {

        $basket = session('basket.products');
        if(isset($basket) && !empty($basket))
        {
            $basket = session('basket.products');
            return view('order', ['basket' => $basket]);
        }

        return redirect('/');

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
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function store(Request $request)
    {
            $newCustomer = $request->input('form.customer');
            $token = bin2hex(openssl_random_pseudo_bytes(4));
            $products = session('basket.products');

             $request->validate([
                'form.customer.*' => 'required',
                'form.customer.email' => 'email',
                'form.customer.complement' => 'nullable',
                'form.customer.zip' => 'numeric',
                'form.card.*' => 'required',
                'form.*.card_number' => 'numeric|digits_between:16,16',
                'form.*.cvc' => 'numeric|digits_between:3,3',
                'form.*.expiration_month' => 'numeric|digits_between:2,2',
                'form.*.expiration_year' => 'numeric|digits_between:4,4',
            ]);



            $customer = new Customer();
            $customer->name = $newCustomer['name'];
            $customer->email = $newCustomer['email'];
            $customer->address = $newCustomer['address'];
            $customer->address_complement = $newCustomer['complement'];
            $customer->city = $newCustomer['city'];
            $customer->zip = $newCustomer['zip'];
            $customer->save();


            $order = new Order();
            $order->order_token = $token;
            $order->customer_id = $customer->id;
            $order->save();

            foreach ($products as $product) {
                $order_products = new Orders_products();
                $order_products->order_id = $order->id;
                $order_products->product_id = $product['id'];
                $order_products->quantity = $product['quantity'];
                $order_products->save();
            }

            $orderInfo = new OrderInfo();
            $orderInfo->token = $order->order_token;

        Mail::to($customer->email)->send(new MailtrapExample($orderInfo));
        Mail::to('admin@basketBoss.fr')->send(new AdminMail());

        return redirect('/order/confirm');
    }


    public function show(Customer $customer)
    {
          $products = session('basket.products');
        if (!isset($products) )
            return redirect('/');

          session()->forget('basket');
          $data = $customer->latest()->first();

        return view('recap',['customer' => $data, 'products' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
