<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscount extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $discount = new App\Discount();
        $discount->discount_name = 'NORMAL PRICING - NO DISCOUNT';
        $discount->discount_rate = '0';
        $discount->save();

        $discount = new App\Discount();
        $discount->discount_name = 'MATES RATES CATEGORY 1 - 5%';
        $discount->discount_rate = '5';
        $discount->save();

        $discount = new App\Discount();
        $discount->discount_name = 'MATES RATES CATEGORY 2 - 10%';
        $discount->discount_rate = '10';
        $discount->save();

        $discount = new App\Discount();
        $discount->discount_name = 'MATES RATES CATEGORY 3 - 20%';
        $discount->discount_rate = '20';
        $discount->save();

        $discount = new App\Discount();
        $discount->discount_name = 'REAL ESTATE / STRATA CATERGORY 1 - 5%';
        $discount->discount_rate = '5';
        $discount->save();

        $discount = new App\Discount();
        $discount->discount_name = 'REAL ESTATE / STRATA CATEGORY 2 - 10%';
        $discount->discount_rate = '10';
        $discount->save();

        $discount = new App\Discount();
        $discount->discount_name = 'REAL ESTATE / STRATA CATEGORY 3 - 15%';
        $discount->discount_rate = '15';
        $discount->save();

        $discount = new App\Discount();
        $discount->discount_name = 'REAL ESTATE / STRATA CATEGORY 4 - 20%';
        $discount->discount_rate = '20';
        $discount->save();

        $discount = new App\Discount();
        $discount->discount_name = 'LOYAL CUSTOMER - 10%';
        $discount->discount_rate = '10';
        $discount->save();

        $discount = new App\Discount();
        $discount->discount_name = 'GENERAL CUSTOMER DISCOUNT - 10%';
        $discount->discount_rate = '10';
        $discount->save();

        $discount = new App\Discount();
        $discount->discount_name = 'PROMOTIONAL DISCOUNT 1 - 5%';
        $discount->discount_rate = '5';
        $discount->save();
        
        $discount = new App\Discount();
        $discount->discount_name = 'PROMOTIONAL DISCOUNT 2 - 10%';
        $discount->discount_rate = '10';
        $discount->save();

        $discount = new App\Discount();
        $discount->discount_name = 'PROMOTIONAL DISCOUNT 3 - 15%';
        $discount->discount_rate = '15';
        $discount->save();
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
