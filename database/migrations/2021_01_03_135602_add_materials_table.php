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
            $table->foreignId('fk_supplier_id')->references('pk_supplier_id')->on('suppliers')->nullable();
            $table->string('material_itemname')->nullable();
            $table->string('material_description');
            $table->double('material_cost');
            $table->tinyInteger('material_archived')->default(0);
            $table->timestamps();
        });

        $materials = new App\Material();
        $materials->fk_supplier_id = '1';
        $materials->material_itemname = 'None';
        $materials->material_description = 'Service Call inspection Only - 30 mins only';
        $materials->material_cost = '0';
        $materials->save();

        $materials = new App\Material();
        $materials->fk_supplier_id = '1';
        $materials->material_description = 'LED EMERGENCY oyster light + fixings + Misc + Cable ( 10 -30 metres ) - No conduit work';
        $materials->material_cost = '160';
        $materials->save();
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
