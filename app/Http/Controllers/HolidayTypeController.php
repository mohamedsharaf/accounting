<?php

namespace App\Http\Controllers;

use App\HolidayType;
use Illuminate\Http\Request;

class HolidayTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $types = HolidayType::all();
        
        return response()->json($types, 200);
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
     * @param  \App\HolidayType  $holidayType
     * @return \Illuminate\Http\Response
     */
    public function show(HolidayType $holidayType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\HolidayType  $holidayType
     * @return \Illuminate\Http\Response
     */
    public function edit(HolidayType $holidayType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\HolidayType  $holidayType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, HolidayType $holidayType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\HolidayType  $holidayType
     * @return \Illuminate\Http\Response
     */
    public function destroy(HolidayType $holidayType)
    {
        //
    }
}
