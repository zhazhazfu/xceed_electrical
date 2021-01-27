<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrefixesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prefixes', function (Blueprint $table) {
            $table->id('pk_prefix_id');
            $table->string('prefix_name');
            $table->timestamps();
        });

        $prefixes = new App\prefix();
        $prefixes->pk_prefix_id = 1;
        $prefixes->prefix_name = 'Q';
        $prefixes->save();

        $prefixes = new App\prefix();
        $prefixes->pk_prefix_id = 2;
        $prefixes->prefix_name = 'PQ';
        $prefixes->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
    }
}
