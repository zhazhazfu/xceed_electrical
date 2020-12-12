<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrossmarginsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grossmargins', function (Blueprint $table) {
            $table->id('pk_gm_id');
            $table->double('gm_rate');
            $table->timestamps();
        });

        $grossmargin = new App\GrossMargin();
        $grossmargin->gm_rate = 1.739;
        $grossmargin->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grossmargins');
    }
}
