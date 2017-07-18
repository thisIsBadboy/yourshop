<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    public static $rules = [
    	'name'=>'required',
    	'description'=>'required'
    ];

    protected $fillable = ['name', 'description', 'user_id'];

    public function user(){
    	return $this->belongsTo('App\Model\User');
    }

    public function products(){
        return $this->hasMany('App\Model\Product');
    }

    public function accounts(){
        return $this->hasMany('App\Model\Account');
    }

    public function account_configurations(){
        return $this->hasMany('App\Model\AccountConfiguration');
    }

    public function sale_invoices(){
        return $this->hasMany('App\Model\SaleInvoice');
    }

    public function journal_entries(){
        return $this->hasMany('App\Model\JournalEntry');
    }
}
