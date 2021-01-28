<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuoteTable extends Migration
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
            $table->foreignId('fk_user_id')->references('pk_user_id')->on('users');
            $table->foreignId('fk_term_id')->references('pk_term_id')->on('quoteterms');
            // $table->foreignId('fk_in_id')->references('pk_in_id')->on('inclusions');
            // $table->foreignId('fk_ex_id')->references('pk_ex_id')->on('exclusions');
            $table->foreignId('fk_prefix_id')->references('pk_prefix_id')->on('prefixes');
            $table->string('quote_number');
            $table->string('inclusions');
            $table->string('exclusions');
            $table->integer('quote_status');
            $table->integer('quote_revisonnumber')->nullable();
            $table->string('quote_comment')->nullable();
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
