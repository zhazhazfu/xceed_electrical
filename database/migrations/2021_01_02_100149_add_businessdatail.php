<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddBusinessdatail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $businessdetails = new App\BusinessDetail();
        $businessdetails->businessdetail_name = 'Xceed Electrical';
        $businessdetails->businessdetail_addressline1 = 'PO Box 492';
        $businessdetails->businessdetail_addressline2 = 'Moorebank NSW 1875';
        $businessdetails->businessdetail_phone = '0415240296';
        $businessdetails->businessdetail_fax = '02 9730 2641';
        $businessdetails->businessdetail_email = 'info@xceedelectrical.com.au';
        $businessdetails->businessdetail_website = 'www.xceedelectrical.com.au';
        $businessdetails->businessdetail_archived = 0;
        $businessdetails->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('businessdetails');
    }
}
