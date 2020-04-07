<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;
use Validator;
class AddressController extends Controller
{

    public $user_id;

    public function __construct()
    {
        $this->user_id = 1;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $address = Address::where('user_id', $this->user_id)->get();
        return response()->json($address, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = 1; //Auth()->user()->id;

        //validation
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'street' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip_code' => 'required',
                'country' => 'required',
            ]
        );

        //if validation fails
        if($validation->fails()) return response()->json($validation->errors()->all(), 422);


        try{
            //for inject request with user_id
            $request['user_id'] = $this->user_id;


            //to rest all default address if this user is default
            if($request->default == 1)
            Address::Where('user_id',$this->user_id)->update(['default'=>0]);

            $address = Address::create($request->all());
            return response()->json($address, 200 );

        }catch(\Exception $e){
            return response()->json($e, 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        return response()->json($address, 200 );
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function default()
    {
        $address = Address::where([
            ['user_id', $this->user_id],
            ['default',1]
        ])->first();
        return response()->json($address, 200);
    }    



    /**
     * Display the specified resource.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function setAsDefault(Address $address)
    {
        Address::Where('user_id', $this->user_id)->update(['default' => 0]);
        $address->update(['default' => !$address->default ]);
        return response()->json($address, 200);
    }  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Address $address)
    {

        //validation
        $validation = Validator::make(
            $request->all(),
            [
                'title' => 'required',
                'street' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip_code' => 'required',
                'country' => 'required',
            ]
        );

        //if validation fails
        if ($validation->fails()) return response()->json($validation->errors()->all(), 422);


        try {

            //to rest all default address if this user is default
            if ($request->default == 1)
                Address::Where('user_id', $this->user_id)->update(['default'=> 0]);


            $address->update($request->all());
            return response()->json($address, 200);

        } catch (\Exception $e) {
            return response()->json($e, 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(Address $address)
    {
        $address = $address->delete();
        return response()->json($address, 200);
    }
}
