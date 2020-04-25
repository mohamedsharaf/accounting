<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Company;
use Validator;

class ProjectsController extends Controller
{


    public function all(Company $company)
    {
        $projects = $company->projects;
        return response()->json($projects, 200);
    }


    public function get(Project $project)
    {
        $project['employees'] = $project->employees()->select('employees.id', 'employees.name', 'occupation')->get();

        if ($project) {
            return response()->json($project, 200);
        }
        return response()->json(false, 422);
    }


    public function getProjectsOfCompany(Company $company)
    {
        if ($company) {
            $project = $company->projects;
            return response()->json($project, 200);
        }
        return response()->json(false, 422);
    }

    public function delete(Project $project)
    {
        if ($project) {
            $project->delete();
            return response()->json(true, 200);
        }
        return response()->json(false, 422);
    }


    public function update(Project $project ,Request $request)
    {

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'company'=>'required',
        ]);

        if ($validation->fails()) {
            return response()->json('اسم المشروع مطلوب', 422);
        }
        if (!$project) {
            return response()->json('يوحد مشكله', 422);
        }

        $project->name = $request->name;
        $project->company_id = $request->company;
        $project->save();

        $project->employees()->sync($request->employees);

        return response()->json(true, 200);
    }


    public function store(Company $company,Request $request)
    {

        $user = ['id' => 1];

        $validation = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json('اسم المشروع مطلوب', 422);
        }
        if (!$company) {
            return response()->json('يوحد مشكله', 422);
        }
        $project = $company->projects()->create([
            'name' => $request->name,
        ]);

        $project->employees()->sync($request->employees);

        return response()->json(true, 200);
    }
}
