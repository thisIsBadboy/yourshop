<?php

namespace App\Http\Controllers;

use DummyFullModelClass;
use App\Model\Business;
use Illuminate\Http\Request;
use DB;

class JournalEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Model\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function index(Business $business)
    {
        $journal_entries = DB::table('journal_entries')
                                ->select(
                                    'journal_entries.id',
                                    'journal_entries.created_at',
                                    'journal_entries.updated_at',
                                    DB::raw("SUM(CASE WHEN entry_type = 'dr' THEN amount END) AS debit_amount"),
                                    DB::raw("SUM(CASE WHEN entry_type = 'cr' THEN amount END) AS credit_amount")
                                )
                                ->join('journal_items', function($join) use ($business){
                                    $join->on('journal_entries.id', '=', 'journal_items.journal_entry_id')
                                    ->where('journal_entries.business_id', '=', $business->id);
                                })
                                ->groupBy('journal_entries.id')
                                ->orderBy('journal_entries.created_at', 'desc')
                                ->get();

        return view('accounting.journal-entry-list', ['business'=>$business, 'journal_entries'=>$journal_entries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Model\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function create(Business $business)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Business $business)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Business  $business
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business, DummyModelClass $DummyModelVariable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Business  $business
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function edit(Business $business, DummyModelClass $DummyModelVariable)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Business  $business
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Business $business, DummyModelClass $DummyModelVariable)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Business  $business
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function destroy(Business $business, DummyModelClass $DummyModelVariable)
    {
        //
    }
}
