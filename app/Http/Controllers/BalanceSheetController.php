<?php

namespace App\Http\Controllers;

use DummyFullModelClass;
use App\Model\Business;
use Illuminate\Http\Request;
use App\Business\BusinessReport;

class BalanceSheetController extends Controller
{
    protected $businessReport;
    public function __construct(BusinessReport $businessReport){
        $this->businessReport = $businessReport;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Model\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function index(Business $business)
    {
        $balance_sheet_bundle = $this->businessReport->getBalanceSheet($business);
        //return $balance_sheet_bundle;

        return view('accounting.balance-sheet', ['business'=>$business, 'balance_sheet_bundle'=>$balance_sheet_bundle]);
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
