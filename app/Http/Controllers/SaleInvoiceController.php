<?php

namespace App\Http\Controllers;

use DummyFullModelClass;
use DB;
use App\Model\Business;
use Illuminate\Http\Request;
use App\Business\BusinessSaleInvoice;
use App\Model\SaleInvoice;

class SaleInvoiceController extends Controller
{
    protected $businessSaleInvoice;

    public function __construct(BusinessSaleInvoice $businessSaleInvoice){
        $this->businessSaleInvoice = $businessSaleInvoice;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Model\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function index(Business $business)
    {
        $sale_invoice = $business->sale_invoices()
        ->leftJoin('sale_invoice_payment_histories', function($join){
            $join->on('sale_invoices.id', '=', 'sale_invoice_payment_histories.sale_invoice_id');
        })
        ->groupBy('sale_invoices.id')
        ->select(
            'sale_invoices.*',
            DB::raw("COALESCE(SUM(sale_invoice_payment_histories.paid_amount), 0) AS total_paid_amount")
        )
        ->get();

        //$sale_invoice = $business->sale_invoices()->get();

        return view('sale-invoice', ['business'=>$business, 'sale_invoice'=>$sale_invoice]);
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
        $input = $request->input('form');

        if(! $this->businessSaleInvoice->createSaleInvoice($business, $input)){
            return back()->withInput();
        }

        return redirect()->route('business.product.index', $business);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Business  $business
     * @param  \DummyFullModelClass  $DummyModelVariable
     * @return \Illuminate\Http\Response
     */
    public function show(Business $business, SaleInvoice $saleInvoice)
    {
        $sale_invoice_items = $saleInvoice->invoice_items()
        ->join('products', function($join){
            $join->on('sale_invoice_items.product_id', '=', 'products.id');
        })
        ->select(
            'sale_invoice_items.id',
            'sale_invoice_items.qty',
            'sale_invoice_items.subtotal',
            'products.title'
        )
        ->get();

        $total_qty = $total_amount = 0;
        foreach($sale_invoice_items as $item){
            $total_qty += $item->qty;
            $total_amount += $item->subtotal;
        }

        $sale_invoice = ['contents'=>$sale_invoice_items, 'total_qty'=>$total_qty, 'total_amount'=>$total_amount];

        return view('sale_invoice_item', ['business'=>$business, 'sale_invoice'=>$sale_invoice]);
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
