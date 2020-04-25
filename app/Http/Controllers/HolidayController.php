<?php

namespace App\Http\Controllers;

use App\Holiday;
use Illuminate\Http\Request;
use Validator;
use DateTime;

class HolidayController extends Controller
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
        try {
            $validation = Validator::make($request->all(), [
                'holidayType_id' => 'required',
                'employee_id' => 'required',
                'approver_id' => 'required',
                'start' => 'required',
                'end' => 'required',
            ]);

            if ($validation->fails()) return response()->json($validation->errors->all(), 422);

            $request['start'] = new DateTime($request->start);
            $request['end'] = new DateTime($request->end);

            Holiday::create($request->all());

            return response()->json(true, 200);
        } catch (\Exception $e) {
            return response()->json($e, 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function show(Holiday $holiday)
    {
        return response()->json($holiday, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function edit(Holiday $holiday)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Holiday $holiday)
    {
        try {
            $validation = Validator::make($request->all(), [
                'holidayType_id'=>'required',
                'start' => 'required',
                'end' => 'required',
            ]);

            if ($validation->fails()) return response()->json($validation->errors->all(), 422);

            $request['start'] = new DateTime($request->start);
            $request['end'] = new DateTime($request->end);

            $holiday->update($request->all());

            return response()->json(true, 200);
        } catch (\Exception $e) {
            return response()->json($e, 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Holiday  $holiday
     * @return \Illuminate\Http\Response
     */
    public function destroy(Holiday $holiday)
    {
        try{
            $holiday->delete();
            return response()->json(true, 200);
        }
        catch(\Exception $e){
            return response()->json($e, 422);
        }
    }
}
