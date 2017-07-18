<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SaleInvoice extends Model
{
	public function business(){
		return $this->belongsTo('App\Model\Business');
	}

	public function invoice_items(){
		return $this->hasMany('App\Model\SaleInvoiceItem');
	}

    public function paid_histories(){
    	return $this->hasMany('App\Model\SaleInvoicePaidHistory');
    }
}
