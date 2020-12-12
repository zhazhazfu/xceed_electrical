<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materials', function (Blueprint $table) {
            $table->id('pk_material_id');
            $table->foreignId('fk_supplier_id')->references('pk_supplier_id')->on('suppliers');
            $table->string('material_itemcode')->nullable();
            $table->string('material_description');
            $table->foreignId('fk_gm_id')->references('pk_gm_id')->on('grossmargins');
            $table->tinyInteger('material_archived');
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
        Schema::dropIfExists('materials');
    }
}
