<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGM extends Migration
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
            $table->double('gm_percentage');
            $table->double('gm_rate');
            $table->timestamps();
        });

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 1;
        $grossmargins->gm_rate = 1.111;
        $grossmargins->gm_percentage = 10;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 2;
        $grossmargins->gm_rate = 1.143;
        $grossmargins->gm_percentage = 12.5;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 3;
        $grossmargins->gm_rate = 1.176;
        $grossmargins->gm_percentage = 15;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 4;
        $grossmargins->gm_rate = 1.25;
        $grossmargins->gm_percentage = 20;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 5;
        $grossmargins->gm_rate = 1.29;
        $grossmargins->gm_percentage = 22.5;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 6;
        $grossmargins->gm_rate = 1.333;
        $grossmargins->gm_percentage = 25;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 7;
        $grossmargins->gm_rate = 1.379;
        $grossmargins->gm_percentage = 27.5;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 8;
        $grossmargins->gm_rate = 1.429;
        $grossmargins->gm_percentage = 30;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 9;
        $grossmargins->gm_rate = 1.481;
        $grossmargins->gm_percentage = 32.5;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 10;
        $grossmargins->gm_rate = 1.4925;
        $grossmargins->gm_percentage = 33;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 11;
        $grossmargins->gm_rate = 1.538;
        $grossmargins->gm_percentage = 35;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 12;
        $grossmargins->gm_rate = 1.6;
        $grossmargins->gm_percentage = 37.5;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 13;
        $grossmargins->gm_rate = 1.667;
        $grossmargins->gm_percentage = 40;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 14;
        $grossmargins->gm_rate = 1.739;
        $grossmargins->gm_percentage = 42.5;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 15;
        $grossmargins->gm_rate = 1.818;
        $grossmargins->gm_percentage = 45;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 16;
        $grossmargins->gm_rate = 1.905;
        $grossmargins->gm_percentage = 47.5;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 17;
        $grossmargins->gm_rate = 2;
        $grossmargins->gm_percentage = 50;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 18;
        $grossmargins->gm_rate = 2.1092;
        $grossmargins->gm_percentage = 52.5;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 19;
        $grossmargins->gm_rate = 2.223;
        $grossmargins->gm_percentage = 55;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 20;
        $grossmargins->gm_rate = 2.3529;
        $grossmargins->gm_percentage = 57.5;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 21;
        $grossmargins->gm_rate = 2.5;
        $grossmargins->gm_percentage = 60;
        $grossmargins->save();
        
        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 22;
        $grossmargins->gm_rate = 2.666;
        $grossmargins->gm_percentage = 62.5;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 23;
        $grossmargins->gm_rate = 2.852;
        $grossmargins->gm_percentage = 65;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 24;
        $grossmargins->gm_rate = 3.075;
        $grossmargins->gm_percentage = 67.5;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 25;
        $grossmargins->gm_rate = 3.333;
        $grossmargins->gm_percentage = 70;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 26;
        $grossmargins->gm_rate = 4;
        $grossmargins->gm_percentage = 75;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 27;
        $grossmargins->gm_rate = 5;
        $grossmargins->gm_percentage = 80;
        $grossmargins->save();

        $grossmargins = new App\GrossMargin();
        $grossmargins->pk_gm_id = 28;
        $grossmargins->gm_rate = 6.667;
        $grossmargins->gm_percentage = 85;
        $grossmargins->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('grossmargins', function(Blueprint $table) {
            $table->integer('gm_persentage');
        });
    }
}
