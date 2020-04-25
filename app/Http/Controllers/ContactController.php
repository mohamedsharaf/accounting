<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Company;
use Illuminate\Http\Request;
use Validator;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $company = $request->company;
        $contacts = Company::find($company);
        
        return response()->json($contacts->contacts, 200);
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
        try{

            $company = $request->company;

            $validation = Validator::make($request->all(),[
                'name'=>'required',
                'email'=>'required',
            ]);

            if($validation->fails()){
                return response()->json($validation->errors->all(), 422);
            }

            Company::find($company)->contacts()->create($request->all());
            return response()->json(true, 200);

        }
        catch(\Exception $e){
            return response()->json($e, 422); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return response()->json($contact, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        try {

            $validation = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required',
            ]);

            if ($validation->fails()) {
                return response()->json($validation->errors->all(), 422);
            }

            $contact->update($request->all());
            return response()->json(true, 200);
        } catch (\Exception $e) {
            return response()->json($e, 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        try {
           $contact->delete();
           return response()->json(true, 200);
        } catch (\Exception $e) {
            return response()->json($e, 422);
        }
    }
}
