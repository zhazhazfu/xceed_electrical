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
            $table->foreignId('fk_item_has_materails_id')->references('pk_item_has_materails_id')->on('item_has_materials');
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
