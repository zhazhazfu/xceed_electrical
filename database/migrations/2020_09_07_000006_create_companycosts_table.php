<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanycostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companycosts', function (Blueprint $table) {
            $table->id('pk_companycost_id');
            $table->string('companycost_name');
            $table->double('companycost_yearly');
            $table->tinyInteger('companycost_archived');
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
        Schema::dropIfExists('companycosts');
    }
}
