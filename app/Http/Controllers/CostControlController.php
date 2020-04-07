<?php

namespace App\Http\Controllers;

use App\CostControl;
use Illuminate\Http\Request;

class CostControlController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CostControl  $costControl
     * @return \Illuminate\Http\Response
     */
    public function show(CostControl $costControl)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CostControl  $costControl
     * @return \Illuminate\Http\Response
     */
    public function edit(CostControl $costControl)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CostControl  $costControl
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CostControl $costControl)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CostControl  $costControl
     * @return \Illuminate\Http\Response
     */
    public function destroy(CostControl $costControl)
    {
        //
    }



    public function test(Request $request){

       return $request->user();

    }
}
