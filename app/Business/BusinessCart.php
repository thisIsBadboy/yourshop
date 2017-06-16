<?php

namespace App\Business;

use App\Model\Business;

class BusinessCart {

	public function __construct(){

	}

	public function getCart($business_id, $cart_contents){
		$cart = $this->makeBundle($business_id, $cart_contents);

		return $cart;
	}

	private function makeBundle($business_id, $cart_contents){
		$contents = [];
		$total_amount = $total_qty = 0;

		try{
			$business = Business::find($business_id);

	        foreach($cart_contents as $key=>$item){
	            $contents[$item->rowId] = $business->product()->find($item->id);
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