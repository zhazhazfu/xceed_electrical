<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddExclusionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exclusions', function (Blueprint $table) {
            $table->id('pk_ex_id');
            $table->text('exclusion_name');
            $table->longText('exclusion_Content');
            $table->timestamps();
        });

        $exclusions = new App\Exclusions();
        $exclusions->exclusion_name = 'Default';
        $exclusions->exclusion_Content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Duis semper arcu nec hendrerit mattis.
        Nullam id lorem eu dolor congue varius a non nisi.
        Donec quis nisi nec leo viverra lobortis eu ut lacus.';
        $exclusions->save();
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
