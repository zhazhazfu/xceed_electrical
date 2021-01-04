<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMaterialsTable extends Migration
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
            $table->double('material_cost');
            $table->tinyInteger('material_archived')->default(0);
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
