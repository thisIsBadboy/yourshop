<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JournalItem extends Model
{
    public $timestamps = false;

    protected $hidden = [];

    public function account(){
    	return $this->belongsTo('App\Model\Account');
    }
}
