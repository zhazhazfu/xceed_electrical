<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddInclusionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inclusions', function (Blueprint $table) {
            $table->id('pk_in_id');
            $table->text('inclusion_name');
            $table->longText('inclusion_Content');
            $table->timestamps();
        });

        $inclusions = new App\Inclusions();
        $inclusions->inclusion_name = 'Default';
        $inclusions->inclusion_Content = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.
        Duis semper arcu nec hendrerit mattis.
        Nullam id lorem eu dolor congue varius a non nisi.
        Donec quis nisi nec leo viverra lobortis eu ut lacus.';
        $inclusions->save();
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
