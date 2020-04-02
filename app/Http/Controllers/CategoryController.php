<?php

namespace App\Http\Controllers;

use App\Category;
use App\Company;
use App\Helpers\CategoryHelper;
use Illuminate\Http\Request;
use Validator;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Category::all(), 200);
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
        $validation  = Validator::make($request->all(), [
            'title' => 'required',
            'company_id' => 'required',
            'branch_id' => 'required',
        ]);

        if ($validation->fails()) return response()->json($validation->errors()->all(), 442,);

        $product = Category::firstOrCreate($request->all());

        return response()->json($product, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return response()->json($category, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validation  = Validator::make($request->all(), [
            'title' => 'required',
            'company_id' => 'required',
            'branch_id' => 'required',
        ]);

        if ($validation->fails()) return response()->json($validation->errors()->all(), 442,);

        $product = $category->update($request->all());

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->children()->delete();
        $category->delete();
        return response()->json(true, 200,);
    }
}
