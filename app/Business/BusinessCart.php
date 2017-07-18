<?php

namespace App\Business;

use App\Model\Business;

class BusinessCart {

	public function __construct(){

	}

	public function getCart(Business $business, $cart_contents){
		$cart = $this->makeBundle($business, $cart_contents);

		return $cart;
	}

	private function makeBundle(Business $business, $cart_contents){
		$contents = [];
		$total_amount = $total_qty = 0;

		try{
			
	        foreach($cart_contents as $key=>$item){
	            $contents[$item->rowId] = $business->products()->find($item->id);
	            $contents[$item->rowId]['qty'] = $item->qty;
	            $contents[$item->rowId]['subtotal'] = $item->subtotal;

	            $total_qty += intval($item->qty);
	            $total_amount += floatval($item->subtotal);
	        }
	    }catch(Exception $e){
	    	
	    }

        $cart = ['contents'=>$contents, 'total_qty'=>$total_qty, 'total_amount'=>$total_amount];
		
		return $cart;
	}
}