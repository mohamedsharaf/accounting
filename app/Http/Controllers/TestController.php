<?php

namespace App\Http\Controllers;

use App\Test;
use Illuminate\Http\Request;
use DateTime;
class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Test::all();
        return response()->json($data, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->json([], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request['birthday'] = new DateTime($request->birthday);
            $request['languages'] = json_encode($request->languages);
            
            //Store All data income
            $data = Test::Create($request->all());
            return response()->json($data, 200);
        }
        catch(\Exception $e){
            return response()->json($e, 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\test  $test
     * @return \Illuminate\Http\Response
     */
    public function show(Test $test)
    {
        return response()->json($test, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\test  $test
     * @return \Illuminate\Http\Response
     */
    public function edit(Test $test)
    {
        $test['languages'] = json_decode($test->languages);
        return response()->json($test, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\test  $test
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Test $test)
    {
        try {
            $request['birthday'] = new DateTime($request->birthday);
            $request['languages'] = json_encode($request->languages);
            $data = $test->update($request->all());
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json($e, 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\test  $test
     * @return \Illuminate\Http\Response
     */
    public function destroy(Test $test)
    {
        try {
            $test->delete();
            return response()->json([], 200);
        } catch (\Exception $e) {
            return response()->json($e, 422);
        }
    }
}
