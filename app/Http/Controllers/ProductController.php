<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;
use Validator;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Product::all(), 200);
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
            'title'=>'required',
            'price'=>'required',
            'company_id'=>'required',
            'category_id'=>'required',
            'quantity'=>'required',
            'image'=>'required'
        ]);


        if($validation->fails()) return response()->json($validation->errors()->all(), 442, );
        
        $category = Category::find($request->category_id);
        
        $product = $category->products()->firstOrCreate($request->except('image', 'category_id'));
        $product->addMedia($request->file('image'))->toMediaCollection('product_image');

        return response()->json($product, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        $product['category'] = $product->category;
        return response()->json($product, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $validation  = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required',
            'category_id' => 'required',
            'quantity' => 'required',
        ]);


        if ($validation->fails()) return response()->json($validation->errors()->all(), 442,);

        $product->update($request->except('image', 'category_id'));
        $product->category()->sync($request->category_id);

        if($request->hasFile('image'))
        {
            $product->deletePreservingMedia(); 
            $product->addMedia($request->file('image'))->toMediaCollection('product_image');
        }

        return response()->json($product, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->deletePreservingMedia();
        $product->delete();
        return response()->json(true, 200,);
    }
}
