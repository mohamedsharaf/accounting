<?php

namespace App\Http\Controllers;

use App\Company;
use App\Journal;
use Illuminate\Http\Request;
use DateTime;
class JournalController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCompany(Request $request)
    {
        $company = Company::find($request->company);
        return response()->json($company->journals, 200);
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
        //convert date to dateTime
        $request['paid_at'] = new DateTime($request->paid_at);

        //add date 
        $journal = Journal::create($request->all());
        
        foreach ($request->ledger_rows as $ledger) {

            $ledgerType = isset($ledger['credit']) ? 'credit' : 'debit';
            $amount    = isset($ledger['debit']) ? $ledger['debit'] : $ledger['credit'];

            $journal->ledgers()->create(
                [
                    'company_id' => $request->company_id,
                    'branch_id'  => $request->branch_id,
                    'account_id' => $ledger['account_id'],
                    // 'ledgerable_type'=> $ledgerType,
                    // 'ledgerable_id'=> $request->company_id,
                    'issued_at'=> new DateTime(), // date of journal
                    'entry_type'=> $ledgerType,
                    'debit'=> $ledger['debit'],
                    'credit'=> $ledger['credit'],
                    'amount' => $amount,
                    'amount_foreign' => $amount,
                ]
            );

        }
        
        return response()->json($journal , 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function show(Journal $journal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function edit(Journal $journal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Journal $journal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Journal  $journal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Journal $journal)
    {
        //
    }
}
