<?php

namespace App\Http\Controllers;

use App\Company;
use App\Client;
use App\Category;
use Illuminate\Http\Request;
use App\Helpers\CategoryHelper;
use Validator;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::all();
        return response()->json($company, 200);
    }

    public function get(Company $company)
    {
        if ($company) {
            return response()->json($company, 200);
        }
        return response()->json(false, 422);
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
        $user = ['id' => 1];

        $validation = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json('اسم الشركه مطلوب', 422);
        }

        $comapny = Company::create(
            [
                'name' => $request->name,
                'user_id' => $user['id']
            ]
        );

        return response()->json(true, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return response()->json($company, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        if ($validation->fails()) {
            return response()->json('اسم الشركه مطلوب', 422);
        }
        if (!$company) {
            return response()->json('يوحد مشكله', 422);
        }

        $company->name = $request->name;
        $company->save();

        return response()->json(true, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        if ($company) {
            $company->delete();
            return response()->json(true, 200);
        }
        return response()->json(false, 422);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories(Company $company)
    {
        $categories =  $company->categories()->whereNull('category_id')->get();
        $categories = CategoryHelper::getChildrenOfCategoriesParents($categories);
        return response()->json($categories, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function products(Company $company)
    {
        $products =  $company->products;
        return response()->json($products, 200);
    }

    
    public function allCategories($company)
    {
        $categories =  Category::with('parent')->where('company_id', $company)->get();
        return response()->json($categories, 200);
    }


    /**
     * Display a listing of the resource. 
     *
     * @return \Illuminate\Http\Response
     */
    public function clients(Request $request)
    {
        $clients = [];
        $searchKey = $request->searchKey;
        $company   = $request->company_id;
        $branch   = $request->branch_id;
        
        if($searchKey != null && $searchKey != ''){
            $clients = Client::where([
                ['company_id', $company],
                ['branch_id', $branch],
                ['mobile', $searchKey],

            ])->orWhere([
                ['name' , 'like' , '%' . $searchKey . '%'],
            ])->get();
            
        }
        else{
            $clients = Client::where([
                ['company_id', $company],
                ['branch_id', $branch],
            ])->limit(50)->get();
        }

        return response()->json($clients, 200);
    }



}
