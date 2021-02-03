<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuoteHasItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quote_has_items', function (Blueprint $table) {
            $table->id('pk_quote_has_item_id');
            $table->foreignId('fk_quote_id')->references('pk_quote_id')->on('quotes');
            $table->foreignId('fk_item_id')->references('pk_item_id')->on('items');
            $table->integer('item_quantity')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('GST_price', 10, 2);
            $table->double('item_price')->nullable();
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
        //
    }
}
