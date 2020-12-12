<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class AddUserTypeToTableUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['user','admin'])->default('user')->after('user_name')->nullable();
            $table->dropColumn('user_firstlast');
            $table->dropColumn('user_archived');
            
        });
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_firstlast')->nullable();
            $table->tinyInteger('user_archived')->default(0);
            
        });

        $user = new App\User();
        $user->password = Hash::make('password');
        $user->user_name = 'jconceicao';
        $user->user_firstlast = 'Jayson Conceicao';
        $user->role = 'admin';
        $user->save();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_type');
        });
    }
}
