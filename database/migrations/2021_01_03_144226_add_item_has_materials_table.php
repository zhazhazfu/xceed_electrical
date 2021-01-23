<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemHasMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item_has_materials', function (Blueprint $table) {
            $table->id('pk_item_has_materails_id');
            $table->foreignId('fk_item_id')->references('pk_item_id')->on('items');
<<<<<<< HEAD
            $table->foreignId('fk_material_id')->references('pk_material_id')->on('materials')->onUpdate('cascade');
            $table->bigInteger('quantity');
            $table->tinyInteger('archived')->default(0);
=======
            $table->foreignId('fk_material_id')->references('pk_material_id')->on('materials');
            $table->Integer('quantity');
>>>>>>> a9092e34ca22a85f322ffc7d55a9107842139cee
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
