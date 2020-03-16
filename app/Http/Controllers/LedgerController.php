<?php

namespace App\Http\Controllers;

use App\Ledger;
use App\Company;
use Illuminate\Http\Request;
use DateTime;
class LedgerController extends Controller
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


    public function indexCompany(Company $company){
        return response()->json($company->ledgers, 200);
    }

    public function search(Request $request){

        $searchKeys[]= ['company_id', $request->company_id];
        //Amount
        if(isset($request->amount_from))
            $searchKeys[] = ['amount' , '>=' , $request->amount_from];
        if(isset($request->amount_to))
            $searchKeys[] = ['amount', '<=', $request->amount_to];
        //Acount
        if(isset($request->account_id))
            $searchKeys[] = ['account_id', '=', $request->account_id];
        //date
        if(isset($request->date_from))
            $searchKeys[] = ['issued_at', '>=', new DateTime($request->date_from)];
        if(isset($request->date_to))
            $searchKeys[] = ['issued_at', '<=',  new DateTime($request->date_to)];
        

        $ledger  = Ledger::orWhere($searchKeys)->get();

        return response()->json($ledger, 200);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function show(Ledger $ledger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function edit(Ledger $ledger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ledger $ledger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Ledger  $ledger
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ledger $ledger)
    {
        //
    }
}
