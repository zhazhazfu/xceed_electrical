<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id('pk_customer_id');
            $table->foreignId('fk_discount_id')->references('pk_discount_id')->on('discounts');
            $table->string('customer_name');
            $table->string('customer_company')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_address')->nullable();
            $table->tinyInteger('customer_archived')->default(0);
            $table->timestamps();
        });

        $customers = new App\Customer();
        $customers->fk_discount_id = '1';
        $customers->customer_name = 'James';
        $customers->save();
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
