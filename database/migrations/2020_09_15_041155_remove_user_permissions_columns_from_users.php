<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveUserPermissionsColumnsFromUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table)
        {
            $table->dropColumn([
                'user_access_costsexpenses',
                'user_access_usermanagement',
                'user_access_itemmanagement',
                'user_access_materialmanagement',
                'user_access_suppliermanagement',
                'user_access_customermanagement',
                'user_access_quotemanagement'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
}
