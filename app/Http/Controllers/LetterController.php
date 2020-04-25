<?php

namespace App\Http\Controllers;

use App\Letter;
use App\Company;
use Illuminate\Http\Request;
use Validator;

class LetterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $companyId = $request->company;
        $letters = Company::find($companyId)->letters()->with('projects', 'sections', 'contact')->get();
        return response()->json($letters, 200);
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

        $company = $request->company;

        $validation = Validator::make($request->all(), [
            'subject' => 'required',
            'content' => 'required',
            'type' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors->all(), 422);
        }

        $letter = Company::find($company)->letters()->create($request->all());

        if ($request->sections)
            $letter->sections()->sync($request->sections);
        if ($request->projects)
            $letter->projects()->sync($request->projects);

        return response()->json(true, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function show($letter)
    {
        $letterData = Letter::with('projects','sections','contact')->find($letter);
        return response()->json($letterData, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function edit(Letter $letter)
    {
 
        $sections = $letter->sections;
        $sectionsId=[];
        foreach ($sections as  $value) {
            $sectionsId[]=$value->id;
        }

        $projects = $letter->projects;
        $projectsId = [];
        foreach ($projects as  $value) {
            $projectsId[] = $value->id;
        }


        $letter['projectsIds'] = $projectsId;
        $letter['sectionsIds'] = $sectionsId;

        return response()->json($letter, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Letter $letter)
    {

        $validation = Validator::make($request->all(), [
            'subject' => 'required',
            'content' => 'required',
            'type' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors->all(), 422);
        }
        
        $letter->sections()->sync($request->sections);
        $letter->projects()->sync($request->projects);

        $letter = $letter->update($request->all());


        return response()->json(true, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Letter  $letter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Letter $letter)
    {
        $letter->projects()->detach();
        $letter->sections()->detach();
        $letter->delete();

        return response()->json(true, 200);
    }
}
