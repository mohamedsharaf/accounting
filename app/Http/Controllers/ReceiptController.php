<?php

namespace App\Http\Controllers;

use App\Receipt;
use App\Item;
use Illuminate\Http\Request;
use Validator;
class ReceiptController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validation = Validator::make($request->all(),[
            'client_id'=> 'required',
            'total_payable'=>'required',
            'items'=>'required',
        ]);
        
        if($validation->fails()) return response()->json($validation->errors()->all(), 422);
        
        $items = $request->items;
        unset($request['items']);

        $receipt = Receipt::create($request->all());

        //iterable on items
        foreach ($items as $item) {
            //link items with this receipt
            $receipt->items()->sync( [
                $item['id'] => [ 'quantity'=>$item['quantity'] ]
            ]);
            Item::find($item['id'])->decrement('quantity', $item['quantity']);
        }


        return response()->json($receipt, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function show(Receipt $receipt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function edit(Receipt $receipt)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Receipt $receipt)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Receipt  $receipt
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receipt $receipt)
    {
        //
    }
}
