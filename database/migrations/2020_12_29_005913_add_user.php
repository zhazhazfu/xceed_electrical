<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class AddUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $user = new App\User();
        $user->password = Hash::make('password');
        $user->user_name = 'jconceicao';
        $user->email = 'jconceicao@xceed.com';
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
    }
}
