<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('itemcategories', function (Blueprint $table) {
            $table->id('pk_category_id');
            $table->string('category_name');
            $table->tinyInteger('category_archived')->default(0);
            $table->timestamps();
        });

        $category = new App\Category();
        $category->category_name = 'Lighting';
        $category->save();

        $category = new App\Category();
        $category->category_name = 'Power';
        $category->save();

        $category = new App\Category();
        $category->category_name = 'Switchboard';
        $category->save();

        $category = new App\Category();
        $category->category_name = 'Data';
        $category->save();

        $category = new App\Category();
        $category->category_name = 'Audio Visual';
        $category->save();

        $category = new App\Category();
        $category->category_name = 'Mains Power';
        $category->save();

        $category = new App\Category();
        $category->category_name = 'Antenna';
        $category->save();

        $category = new App\Category();
        $category->category_name = 'Three Phase';
        $category->save();

        $category = new App\Category();
        $category->category_name = 'Alarms';
        $category->save();

        $category = new App\Category();
        $category->category_name = 'Garden Lights';
        $category->save();

        $category = new App\Category();
        $category->category_name = 'Intercoms';
        $category->save();

        $category = new App\Category();
        $category->category_name = 'CCTV';
        $category->save();

        $category = new App\Category();
        $category->category_name = 'Hot Water';
        $category->save();

        $category = new App\Category();
        $category->category_name = 'Automation';
        $category->save();

        $category = new App\Category();
        $category->category_name = 'Rewires';
        $category->save();

        $category = new App\Category();
        $category->category_name = 'Service Call Charges';
        $category->save();
        
        $category = new App\Category();
        $category->category_name = 'Labour';
        $category->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('itemcategories');
    }
}
