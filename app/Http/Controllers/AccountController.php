<?php

namespace App\Http\Controllers;

use App\Account;
use App\Company;
use Illuminate\Http\Request;
use Validator;
use AccountHelper;
class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::where('parent_id',null)->get();
        $accounts = AccountHelper::getChildrenOfParents($accounts);
        return response()->json($accounts, 200);
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
        $validation = Validator::Make($request->all(),
            [
                // 'parent_id'=>'required',
                'name'=>'required',
                'code'=>'required',
                'company_id'=>'required',
            ]
        );

        if($validation->fails())
        return response()->json($validation->errors->all(), 422);
        $company = Company::find($request->company_id);
        $company->Accounts()->create($request->all());
        return response()->json($company, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $searchKey = $request->key;

        if(!$searchKey) return response()->json([], 200);
        $accounts = Account::where('code', 'like', "%$searchKey%")
                            ->orWhere(
                                [
                                    ['name', 'like', "%$searchKey%"],
                                ]
                            )->get();

        return response()->json($accounts, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function show(Account $account)
    {
        return response()->json($account, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function edit(Account $account)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        $validation = Validator::Make(
            $request->all(),
            [
                // 'parent_id' => 'required',
                'name' => 'required',
                'code' => 'required',
                'company_id' => 'required',
            ]
        );

        if ($validation->fails()) return response()->json($validation->errors()->all(), 422);

        $account->update($request->all());
        return response()->json($account, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account  $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
