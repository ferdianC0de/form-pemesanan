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
        $destinations = Destination::all('name');
        $dtgraph = Destination::with(['order' => function($query){
            $query->select('destination_id','adultPersons','kidPersons');
            $query->sum('adultPersons');
        }])->get();
        $datagraph = [];
        foreach ($dtgraph as $k => $v) {
            $datagraph[$k]['label'] = $v->name;
            $datagraph[$k]['data'][0] = $v->order->sum('adultPersons');
            $datagraph[$k]['data'][1] = $v->order->sum('kidPersons');
        }

        $dst = [];
        for ($i=0; $i < count($destinations) ; $i++) {
                $dst[$i] = $destinations[$i]->name;
        }
        return view('order.list', compact(['orders', 'dst', 'datagraph']));
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
        $request->merge([
            'visitDate' => date_format(date_create($request->visitDate), 'Y-m-d H:i:s'),
        ]);
        $validated = $request->validate([
            // 'title' => 'required|unique:posts|max:255',
            'name' => 'required',
            'noId' => 'required|max:16|min:16',
            'noHp' => 'required',
            'destination_id' => 'required',
            'visitDate' => 'required',
            'adultPersons' => 'required',
            'kidPersons' => 'required',
            'totalPrice' => 'required',
        ]);

        try {
            Order::insert($validated);
            return redirect('order');
        } catch (\Throwable $th) {
            throw $th;
        }

        // $order = new Order();
        // $order->name = $request->name;
        // $order->noId = $request->noId;
        // $order->noHp = $request->noHp;
        // $order->destination_id = $request->destination;
        // $order->visitDate = date_format(date_create($request->visitDate), 'Y-m-d H:i:s');
        // $order->adultPersons = $request->adultPersons;
        // $order->kidPersons = $request->kidPersons;
        // $order->totalPrice = $request->totalPrice;
        // // return json_encode($order);

        // $order->save();
        // return redirect('order');
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
