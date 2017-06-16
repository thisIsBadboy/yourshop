<?php

namespace App\Http\Controllers;

use DummyFullModelClass;
use App\Model\Business;
use Illuminate\Http\Request;
use Cart;
use App\Model\Product;
use App\Business\BusinessCart;

class CartController extends Controller
{
    protected $businessCart;
    public function __construct(BusinessCart $businessCart){
        $this->businessCart = $businessCart;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Model\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function index(Business $business)
    {

        $cart_contents = Cart::instance($business->id)->content();
        $sale_cart = $this->businessCart->getCart($business->id, $cart_contents);
        
        return view('sale-cart', ['business'=>$business, 'sale_cart'=>$sale_cart]);
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
        $product = $business->product()->find($input['product_id']);

        if(!empty($product)){
            $cart_item = Cart::instance($business->id)->add([
                'id'=>$product->id, 
                'name'=>$product->title, 
                'qty'=>1, 
                'price'=>$product->price
            ]);
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
