<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJournalItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('journal_items', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('journal_entry_id')->unsigned();
            $table->foreign('journal_entry_id')->references('id')->on('journal_entries');
            $table->integer('account_id')->unsigned();
            $table->foreign('account_id')->references('id')->on('accounts');
            $table->enum('entry_type', ['dr', 'cr']);
            $table->double('amount', 8, 5);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('journal_items');
    }
}
