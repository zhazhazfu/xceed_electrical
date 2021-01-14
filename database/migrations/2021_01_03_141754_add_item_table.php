<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id('pk_item_id');
            $table->foreignId('fk_subcategory_id')->references('pk_subcategory_id')->on('itemsubcategories');
            $table->string('item_number');
            $table->string('item_jobtype');
            $table->string('item_description');
            $table->double('item_estimatedtime');
            $table->double('item_servicecall');
            $table->double('item_labourcost')->nullable();
            $table->tinyInteger('item_archived');
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
