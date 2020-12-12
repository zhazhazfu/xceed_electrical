<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('pk_user_id');
            $table->string('user_name')->unique();
            $table->string('user_firstlast');
            $table->string('password');
            $table->tinyInteger('user_access_costsexpenses');
            $table->tinyInteger('user_access_usermanagement');
            $table->tinyInteger('user_access_itemmanagement');
            $table->tinyInteger('user_access_materialmanagement');
            $table->tinyInteger('user_access_suppliermanagement');
            $table->tinyInteger('user_access_customermanagement');
            $table->tinyInteger('user_access_quotemanagement');
            $table->tinyInteger('user_archived');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
