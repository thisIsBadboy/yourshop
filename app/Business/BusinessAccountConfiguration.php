<?php

namespace App\Business;

use App\Model\Business;

class BusinessAccountConfiguration{

	public function __construct(){

	}

	public function getConfiguration(Business $business){
		$account_settings = [];

		try{
			$account_configurations = $business->account_configurations()->get();

	        foreach($account_configurations as $key=>$configuration){
	            $index = $configuration['transaction_type']."_".$configuration['attribute']."_".$configuration['entry_type'];
	            $account_settings[$index]['configuration_id'] = $configuration['id'];
	            $account_settings[$index]['account_id'] = $configuration['account_id'];
	        }
	    }catch(Exception $e){

	    }

	    return $account_settings;
	}
}