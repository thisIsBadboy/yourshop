<?php

namespace App\Http\Controllers;

use DummyFullModelClass;
use App\Model\Business;
use Illuminate\Http\Request;
use App\Model\SaleInvoice;
use App\Model\SaleInvoiceItem;
use App\Business\MyCart;
use Cart;

class SaleInvoiceController extends Controller
{
    protected $myCart;
    public function __construct(MyCart $myCart){
        $this->myCart = $myCart;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Model\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function index(Business $business)
    {
        //
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

        $cart_contents = Cart::instance($business->id)->content();
        $sale_cart = $this->myCart->getCart($business->id, $cart_contents);

        $sale_invoice = new SaleInvoice;
        $sale_invoice->business_id = $business->id;
        $sale_invoice->total_amount = $sale_cart['total_amount'];
        $sale_invoice->paid_amount = $input['paid_amount'];
        $sale_invoice->total_qty = $sale_cart['total_qty'];
        if($sale_invoice->save()){

            foreach($sale_cart['contents'] as $content){
                $sale_invoice_item = new SaleInvoiceItem;
                $sale_invoice_item->invoice_id = $sale_invoice->id;
                $sale_invoice_item->product_id = $content['id'];
                $sale_invoice_item->qty = $content['qty'];
                $sale_invoice_item->subtotal = $content['subtotal'];
                $sale_invoice_item->save();
            }

            Cart::destroy();
            return redirect()->route('business.product.index', $business);
        }

        return back();
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
