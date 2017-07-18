<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SaleInvoiceItem extends Model
{
    public function sale_invoice(){
    	return $this->belongsTo('App\Model\SaleInvoice');
    }
}
