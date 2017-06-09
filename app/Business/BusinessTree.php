<?php

namespace App\Business;
use App\Model\Business;
use App\Model\AccountType;

class BusinessTree {

	public function __construct(){

	}

	public function getCategoryTree(Business $business){
		$categories = $business->category()->orderBy('level', 'asc')->get()->toArray();
		$categories = $this->buildTree($categories);
		
		return $categories;
	}

	public function getAccountTypeTree(){
		$account_types = AccountType::orderBy('level', 'asc')->orderBy('id', 'desc')->get()->toArray();
		$account_types = $this->buildTree($account_types);

		return $account_types;
	}

	private function buildTree($vertex){
		$nodes = [];

		try{
			$total_vertex = count($vertex);

			for($i=0;$i<$total_vertex;$i++){

				$last = [];

				while(($total = count($nodes)) != 0 && $nodes[$total-1]['id'] != $vertex[$i]['parent']){
					$last = array_merge([array_pop($nodes)], $last);
				}

				$nodes = array_merge($nodes, [$vertex[$i]] ,$last);
			}
		}catch(Exception $e){

		}

		return $nodes;
	}
}