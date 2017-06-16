<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Auth;
use App\Model\Business;
use App\Model\Account;
use App\Model\AccountConfiguration;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $businesses = Business::where(['user_id' => Auth::user()->id])->get();
        return view('business-list')->withBusinesses($businesses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create-business');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->input('form');

        $validation = Validator::make($input, Business::$rules);

        if($validation->fails()){
            return back()->withInput()->withErrors();
        }

        $business = Business::create([
            'name' => $input['name'],
            'description' => $input['description'],
            'user_id' => Auth::user()->id
        ]);

        if(empty($business)){
            return back()->withInput()->withErrors();
        }

        $account_name = ["Cash Account", "Receivable Account", "Revenue Account"];
        $account_type_id = [33, 36, 13];
        $account_code = ["1001", "1002", "1003"];

        $account_ids = [];
        for($i=0;$i<count($account_name);$i++){
            $account_ids[] = Account::insertGetId(
                ['business_id'=>$business->id, 'name'=>$account_name[$i], 'type'=>$account_type_id[$i],'code'=>$account_code[$i]]
            );
        }

        AccountConfiguration::insert([
            ['business_id'=>$business->id, 'transaction_type'=>'sale', 'attribute'=>'cash', 'entry_type'=>'dr', 'account_id'=>$account_ids[0]],
            ['business_id'=>$business->id, 'transaction_type'=>'sale', 'attribute'=>'cash', 'entry_type'=>'cr', 'account_id'=>$account_ids[2]],
            ['business_id'=>$business->id, 'transaction_type'=>'sale', 'attribute'=>'due', 'entry_type'=>'dr', 'account_id'=>$account_ids[1]],
            ['business_id'=>$business->id, 'transaction_type'=>'sale', 'attribute'=>'due', 'entry_type'=>'cr', 'account_id'=>$account_ids[2]]
        ]);

        return redirect('business');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $business = Business::find($id);
        return view('business')->withBusiness($business);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
