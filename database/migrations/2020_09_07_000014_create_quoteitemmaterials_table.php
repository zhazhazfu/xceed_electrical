<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuoteitemmaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quoteitemmaterials', function (Blueprint $table) {
            $table->id('pk_quoteitemmaterial_id');
            $table->foreignId('fk_material_id')->references('pk_material_id')->on('materials');
            $table->double('quoteitemmaterial_cost');
            $table->string('quoteitemmaterial_description');
            $table->double('quoteitemmaterial_gmrate');
            $table->integer('quoteitemmaterial_quantity');
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
        Schema::dropIfExists('quoteitemmaterials');
    }
}
