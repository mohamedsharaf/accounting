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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::Make($request->all(),
            [
                'parent_id'=>'required',
                'name'=>'required',
                'code'=>'required',
                'company_id'=>'required',
            ]
        );

        //convert date to dateTime
        $request['paid_at'] = new DateTime($request->paid_at);

        //add date
        $journal = Journal::create($request->all());


        foreach ($request->ledger_rows as $key => $ledger) {
            //TODO VIP Security : check every account company and branch  belongs to auth user company and branch
            if (
            isset($ledger['account_id'])
            ) {
                $amount = isset($ledger['debit']) ? $ledger['debit'] * -1 : $ledger['credit'];
                $journal->ledgers()->create(
                    [
                        'company_id' => $request->company_id,
                        'branch_id' => $request->branch_id,
                        'account_id' => $ledger['account_id'],
                        'issued_at' => $journal->paid_at, // date of journal
                        'amount' => $amount,
                    ]
                );
            }
        }

        return response()->json($journal, 200);
    }


    /**
     * Display the specified resource.
     *
     * @param \App\Journal $journal
     * @return \Illuminate\Http\Response
     */
    public function show(Journal $journal)
    {
        $journal['ledgers'] = $journal->ledgers;
        return response()->json($journal, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Journal $journal
     * @return \Illuminate\Http\Response
     */
    public function edit(Journal $journal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Journal $journal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Journal $journal)
    {
        //convert date to dateTime
        $request['paid_at'] = new DateTime($request->paid_at);

        //add date
        $journal->update($request->all());
        $journal->ledgers()->delete();
        foreach ($request->ledger_rows as $ledger) {

            $ledgerType = isset($ledger['credit']) ? 'credit' : 'debit';
            $amount = isset($ledger['debit']) ? $ledger['debit'] : $ledger['credit'];

            $journal->ledgers()->create(
                [
                    'company_id' => $request->company_id,
                    'branch_id' => $request->branch_id,
                    'account_id' => $ledger['account_id'],
                    'issued_at' => $journal->created_at, // date of journal
                    'entry_type' => $ledgerType,
                    'debit' => $ledger['debit'],
                    'credit' => $ledger['credit'],
                    'amount' => $amount,
                    'amount_foreign' => $amount,
                ]
            );
        }

        return response()->json($journal, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Journal $journal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Journal $journal)
    {
        $journal->delete();
        return response()->json(true, 200);
    }
}
