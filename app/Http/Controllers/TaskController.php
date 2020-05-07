<?php

namespace App\Http\Controllers;

use App\Task;
use App\Company;
use Illuminate\Http\Request;
use Validator;
class TaskController extends Controller
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
    public function store(Company $company, Request $request)
    {
        $validation = Validator::make($request->all(), [
            'title' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors()->all(), 422);
        }

        $task = $company->tasks()->create([
            'title' => $request->title,
        ]);

        $task->employees()->sync($request->employees);

        return response()->json(true, 200);
    }


    public function update(Task $task, Request $request)
    {

        $validation = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors()->all(), 422);
        }
        if (!$task) {
            return response()->json('Error', 422);
        }

        $task->title = $request->title;
        $task->save();

        $task->employees()->sync($request->employees);

        return response()->json(true, 200);
    }

    public function check(Task $task, Request $request)
    {
        $task->completed = $request->completed;
        $task->save();
        return response()->json(true, 200);
    }

    public function get(Task $task)
    {   
        return response()->json($task, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        //
    }


    public function delete(Task $task)
    {
        if ($task) {
            $task->delete();
            return response()->json(true, 200);
        }
        return response()->json(false, 422);
    }
}
