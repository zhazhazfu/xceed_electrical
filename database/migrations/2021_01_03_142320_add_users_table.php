<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Hash;

class AddUsersTable extends Migration
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
            $table->string('user_firstlast')->nullable();
            $table->string('password');
            $table->string('email');
            $table->enum('role', ['user','admin'])->default('user');
            $table->tinyInteger('user_archived')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });

        $user = new App\User();
        $user->password = Hash::make('password');
        $user->user_name = 'jconceicao';
        $user->email = 'jconceicao@xceedelectrical.com';
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
        //
    }
}
