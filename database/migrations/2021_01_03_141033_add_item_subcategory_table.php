<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddItemSubcategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemsubcategories', function (Blueprint $table) {
            $table->id('pk_subcategory_id');
            $table->foreignId('fk_category_id')->references('pk_category_id')->on('itemcategories');
            $table->string('subcategory_name');
            $table->tinyInteger('subcategory_archived')->default(0);
            $table->timestamps();
        });

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 1;
        $subcategory->subcategory_name = 'BATTEN HOLDERS & OYSTER LIGHTS';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 1;
        $subcategory->subcategory_name = 'EMERGENCY  LIGHTS & EMERGENCY OYSTER LIGHTS - REPLACEMENT';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 1;
        $subcategory->subcategory_name = 'EMERGENCY  LIGHTS & EMERGENCY OYSTER LIGHTS - INSTALLATION';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 1;
        $subcategory->subcategory_name = 'LIGHT SWITCHES';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 1;
        $subcategory->subcategory_name = 'SMOKE DETECTORS';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 1;
        $subcategory->subcategory_name = 'LED BATTEN LIGHT';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 1;
        $subcategory->subcategory_name = 'CEILING FANS VARIOUS WITH & WITHOUT LIGHT & REMOTE KITS';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 1;
        $subcategory->subcategory_name = 'LED DOWN LIGHTS';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 1;
        $subcategory->subcategory_name = 'IXL LIGHTS VARIOUS 2 HEAT & 4 HEAT';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 1;
        $subcategory->subcategory_name = 'OUTDOOR LED SPOT LIGHTS';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 1;
        $subcategory->subcategory_name = 'OUTDOOR SENSORS ONLY';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 1;
        $subcategory->subcategory_name = 'WALL LIGHTS INDOOR & OUTDOOR - INSTALL & REPLACEMENT';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 1;
        $subcategory->subcategory_name = 'LED OYSTER LIGHTS SMALL AND LARGE';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 2;
        $subcategory->subcategory_name = 'POWER POINTS SINGLE, DOUBLE & QUAD & USB POWER POINTS';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 2;
        $subcategory->subcategory_name = 'AIR CONDITIONING CIRCUITS & ISOLATORS - SINGLE PHASE CIRCUITS';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 2;
        $subcategory->subcategory_name = 'AIR CONDITIONING ISOLATOR REPLACEMENTS SINGLE & 3 PHASE';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 3;
        $subcategory->subcategory_name = 'CIRCUIT BREAKER / MAIN SWITCH REPLACEMENTS / INSTALLATIONS';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 3;
        $subcategory->subcategory_name = '3 PHASE CIRCUIT BREAKERS REPLACEMENTS / INSTALLATIONS';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 3;
        $subcategory->subcategory_name = '3 POLE ( THREE PHASE ) SAFETY SWITCH REPLACEMENTS / INSTALLATIONS';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 4;
        $subcategory->subcategory_name = 'DATA / PHONE POINT REPAIRS';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 4;
        $subcategory->subcategory_name = 'DATA / PHONE POINT INSTALLATIONS';
        $subcategory->save();

        $subcategory = new App\SubCategory();
        $subcategory->fk_category_id = 4;
        $subcategory->subcategory_name = 'PATCH PANELS REPLACEMENTS / INSTALLATIONS';
        $subcategory->save();
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
