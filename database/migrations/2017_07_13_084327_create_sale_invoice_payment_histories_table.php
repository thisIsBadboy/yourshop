<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSaleInvoicePaymentHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sale_invoice_payment_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_invoice_id')->unsigned();
            $table->foreign('sale_invoice_id')->references('id')->on('sale_invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->double('paid_amount', 15, 8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sale_invoice_payment_histories');
    }
}
