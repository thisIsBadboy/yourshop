<?php

namespace App\Http\Controllers;

use DummyFullModelClass;
use App\Model\Business;
use Illuminate\Http\Request;
use App\Business\BusinessTree;
use App\Model\Product;

class ProductController extends Controller
{
    protected $BusinessTree;

    public function __construct(BusinessTree $BusinessTree){
        $this->BusinessTree = $BusinessTree;
    }
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Model\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function index(Business $business)
    {
        $products = $business->product()->get();
        return view('product.product-list', ['business'=>$business, 'products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Model\Business  $business
     * @return \Illuminate\Http\Response
     */
    public function create(Business $business)
    {
        $categories = $this->BusinessTree->getCategoryTree($business);
        return view('product.add-product', ['business'=>$business, 'categories'=>$categories]);
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

        $product = new Product;
        $product->business_id = $business->id;
        $product->category_id = $input['category'];
        $product->title = $input['title'];
        $product->price = $input['price'];
        if(!$product->save()){
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
