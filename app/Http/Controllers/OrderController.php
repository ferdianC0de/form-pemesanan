<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Destination;
use App\Model\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('order.list', compact('orders'));
    }

    /**
     * Display a Form.
     *
     * @return \Illuminate\Http\Response
     */
    public function form()
    {
        $destinations = Destination::all();
        return view('order.form', compact('destinations'));
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
        // return $request;
        $order = new Order();
        $order->name = $request->name;
        $order->noId = $request->noId;
        $order->noHp = $request->noHp;
        $order->destination_id = $request->destination;
        $order->visitDate = date_format(date_create($request->visitDate), 'Y-m-d H:i:s');
        $order->adultPersons = $request->adultPersons;
        $order->kidPersons = $request->kidPersons;
        $order->totalPrice = $request->totalPrice;
        // return json_encode($order);

        $order->save();
        return redirect('order');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        return view('order.show', compact('order'));
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
