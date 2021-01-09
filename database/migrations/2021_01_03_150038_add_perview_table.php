<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPerviewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perview', function (Blueprint $table) {
            $table->id('pk_perview_id');
            $table->foreignId('fk_quote_id')->references('pk_quote_id')->on('quotes');
            $table->foreignId('pk_perpoint_id')->references('pk_perpoint_id')->on('perpointquotes');
            $table->longText('perview_html');
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
