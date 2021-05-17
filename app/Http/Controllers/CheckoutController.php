<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderHasProduct;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['index']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (session()->has('cart') == false) {
            return redirect()->route('products.index');
        } else {
            $cartProducts = session()->get('cart.products');
            $subtotal = 0;
            $discount = 0;
            $grandTotal = 0;
            $tax = 0;
            foreach (session()->get('cart.products') as $cartProduct) {
                number_format($subtotal += $cartProduct['product']->price * $cartProduct['amount']);
                $discount += ($cartProduct['product']->price * $cartProduct['product']->discount) / 100;
                $tax = ($subtotal * 10) / 100;
                $grandTotal = $subtotal + $tax - $discount;
            }
            return view('components/checkout.index', compact('cartProducts', 'grandTotal', 'subtotal','discount','tax'));
        }
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dateOrder = $request;
        //dd($dateOrder);

        $newOrder = new Order();
        $newOrder->payment = $dateOrder['payment'];
        $newOrder->state = 'pending';
        $newOrder->final_price = $dateOrder['grandTotal'];
        $newOrder->user_id = $dateOrder['userId'];
        $newOrder->save();

        $cartProducts = session()->get('cart.products');

        foreach ($cartProducts as $cartProduct) {
            $orderUser = new OrderHasProduct();
            $orderUser->order_id = $newOrder->id;
            $orderUser->product_id = $cartProduct['product']->id;
            $orderUser->amount = $cartProduct['amount'];
            $orderUser->save();
        }
        return redirect()->route('login');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
