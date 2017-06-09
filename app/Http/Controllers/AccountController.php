<?php

namespace App\Http\Controllers;

use DummyFullModelClass;
use App\Model\Business;
use Illuminate\Http\Request;
use App\Business\BusinessTree;
use App\Model\ChartOfAccount;

class AccountController extends Controller
{
    protected $businessTree;

    public function __construct(BusinessTree $businessTree){
        $this->businessTree = $businessTree;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Model\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function index(Business $business)
    {
        $chart_of_accounts = $business->chart_of_accounts()->get();
        return view('accounting.account-list', ['business'=>$business, 'chart_of_accounts'=>$chart_of_accounts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Model\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function create(Business $business)
    {
        $account_types = $this->businessTree->getAccountTypeTree();

        return view('accounting.create-account', ['business'=>$business, 'account_types'=>$account_types]);
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
        $input = $request->input('form');

        $chartOfAccount = new ChartOfAccount;
        $chartOfAccount->business_id = $business->id;
        $chartOfAccount->name = $input['account_name'];
        $chartOfAccount->type = $input['account_type'];
        $chartOfAccount->code = $input['account_code'];

        if(!$chartOfAccount->save()){
            return back()->withInput();
        }

        return redirect()->route('business.account.index', $business);
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
