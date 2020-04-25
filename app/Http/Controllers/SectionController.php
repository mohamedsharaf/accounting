<?php

namespace App\Http\Controllers;

use App\Section;
use App\Company;
use Illuminate\Http\Request;
use Validator;
class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Section::all(), 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function companySection(Company $company)
    {
        $sections = $company->sections()->with('employees')->get();
        return response()->json($sections, 200);
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
            $validation = Validator::make($request->all(),[
                'title'=>'required|string',
                'company_id'=>'required'
            ]);

            if($validation->fails()) return response()->json($validation->errors->all(), 422);
            
            Section::create($request->all());

            return response()->json(true, 200);
        }
        catch(\Exception $e){
            return response()->json($e, 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        return response()->json($section, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(Section $section)
    {
        return response()->json($section, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Section $section)
    {
        try {
            $validation = Validator::make($request->all(), [
                'title' => 'required|string'
            ]);

            if ($validation->fails()) return response()->json($validation->errors->all(), 422);

            $section->update($request->all());
            $section->save();
            return response()->json(true, 200);
        } catch (\Exception $e) {
            return response()->json($e, 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy(Section $section)
    {
        try {
            $section->delete();
            return response()->json(true, 200);
        } catch (\Exception $e) {
            return response()->json($e, 422);
        }
    }
}
