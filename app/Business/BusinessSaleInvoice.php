<?php

namespace App\Business;

use DB;
use Cart;
use App\Model\Business;
use App\Business\BusinessCart;
use App\Business\BusinessAccountConfiguration;
use App\Model\SaleInvoice, App\Model\SaleInvoiceItem, App\Model\SaleInvoicePaymentHistory;
use App\Model\JournalEntry, App\Model\JournalItem;

class BusinessSaleInvoice{

	protected $businessCart;
	protected $accountConfiguration;

	public function __construct(BusinessCart $businessCart, BusinessAccountConfiguration $accountConfiguration){
		$this->businessCart = $businessCart;
		$this->accountConfiguration = $accountConfiguration;
	}

	public function createSaleInvoice(Business $business, $input = []){

		try{
			$cart_contents = Cart::instance($business->id)->content();
	        $sale_cart = $this->businessCart->getCart($business->id, $cart_contents);

	        $paid_amount = isset($input['paid_amount']) ? floatval($input['paid_amount']) : 0;
	        $paid_amount = $sale_cart['total_amount'] > $paid_amount ? $paid_amount : $sale_cart['total_amount'];

	        $due_amount = $sale_cart['total_amount'] - $paid_amount;

	        $account_settings = $this->accountConfiguration->getConfiguration($business->id);

            DB::beginTransaction();

            $sale_invoice = new SaleInvoice;
            $sale_invoice->business_id = $business->id;
            $sale_invoice->total_amount = $sale_cart['total_amount'];
            $sale_invoice->total_qty = $sale_cart['total_qty'];
            if($sale_invoice->save()){

                foreach($sale_cart['contents'] as $content){
                    $sale_invoice_item = new SaleInvoiceItem;
                    $sale_invoice_item->sale_invoice_id = $sale_invoice->id;
                    $sale_invoice_item->product_id = $content['id'];
                    $sale_invoice_item->qty = $content['qty'];
                    $sale_invoice_item->subtotal = $content['subtotal'];
                    $sale_invoice_item->save();
                }

                if($paid_amount > 0){
                    $payment_history = new SaleInvoicePaymentHistory;
                    $payment_history->sale_invoice_id = $sale_invoice->id;
                    $payment_history->paid_amount = $paid_amount;
                    $payment_history->save();
                }
            }

            $journal_entry = new JournalEntry;
            $journal_entry->business_id = $business->id;
            
            if($journal_entry->save()){
                if($paid_amount != 0){
                    JournalItem::insert([
                        ['journal_entry_id'=>$journal_entry->id, 'account_id'=>$account_settings['sale_cash_dr']['account_id'], 'entry_type'=>'dr', 'amount'=>$paid_amount],
                        ['journal_entry_id'=>$journal_entry->id, 'account_id'=>$account_settings['sale_cash_cr']['account_id'], 'entry_type'=>'cr', 'amount'=>$paid_amount]
                    ]);
                }
                
                if($due_amount != 0){
                    JournalItem::insert([
                        ['journal_entry_id'=>$journal_entry->id, 'account_id'=>$account_settings['sale_due_dr']['account_id'], 'entry_type'=>'dr', 'amount'=>$due_amount],
                        ['journal_entry_id'=>$journal_entry->id, 'account_id'=>$account_settings['sale_due_cr']['account_id'], 'entry_type'=>'cr', 'amount'=>$due_amount]
                    ]);
                }
            }

        }catch(Exception $e){
            DB::rollback();
            return false;
        }

        DB::commit();
        Cart::destroy();
        return true;
	}
}