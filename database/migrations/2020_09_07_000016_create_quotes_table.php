<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id('pk_quote_id');
            $table->foreignId('fk_businessdetail_id')->references('pk_businessdetail_id')->on('businessdetails');
            $table->foreignId('fk_customer_id')->references('pk_customer_id')->on('customers');
            $table->foreignId('fk_quoteitem_id')->references('pk_quoteitem_id')->on('quoteitems');
            $table->foreignId('fk_user_id')->references('pk_user_id')->on('users');
            $table->foreignId('fk_status_id')->references('pk_status_id')->on('statuses');
            $table->integer('quote_number');
            $table->integer('quote_revisionnumber');
            $table->string('quote_comment')->nullable();
            $table->double('quote_discountrate');
            $table->string('quote_termbody');
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
        Schema::dropIfExists('quotes');
    }
}
