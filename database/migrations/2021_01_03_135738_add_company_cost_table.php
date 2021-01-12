<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyCostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companycosts', function (Blueprint $table) {
            $table->id('pk_companycost_id');
            $table->string('companycost_name');
            $table->double('companycost_yearly');
            $table->tinyInteger('companycost_archived')->default(0);
            $table->timestamps();
        });

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Warehouse Rental';
        $companyCost->companycost_yearly = '25500';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Small Business Loan($50K) - Paying $600';
        $companyCost->companycost_yearly = '31200';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Warehouse Electricity - Utilites';
        $companyCost->companycost_yearly = '1600';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Hilux Ute Lease';
        $companyCost->companycost_yearly = '13272';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'VW Van1 - 2017';
        $companyCost->companycost_yearly = '8724';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'VW Van2 - 2014';
        $companyCost->companycost_yearly = '8714';
        $companyCost->save();


        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Carlas Car - Lease';
        $companyCost->companycost_yearly = '7584';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Car Regos';
        $companyCost->companycost_yearly = '5040';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Fuel';
        $companyCost->companycost_yearly = '21600';
        $companyCost->save();
        
        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Ascora Business Software';
        $companyCost->companycost_yearly = '2436';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Accounting Software';
        $companyCost->companycost_yearly = '1200';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Mobile Phone';
        $companyCost->companycost_yearly = '2880';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Office Internet';
        $companyCost->companycost_yearly = '1188';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Etag';
        $companyCost->companycost_yearly = '7800';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Business Insurance + Vehicles Insurance';
        $companyCost->companycost_yearly = '6960';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Car Insurance Carla Car';
        $companyCost->companycost_yearly = '2016';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Telstra Mobiles(Carla + Jayson)';
        $companyCost->companycost_yearly = '1320';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Boost Moible + Optus Sim Shopping Centre';
        $companyCost->companycost_yearly = '840';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Neca Membership';
        $companyCost->companycost_yearly = '1800';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Worker Compensation';
        $companyCost->companycost_yearly = '1200';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Vehicle Tracker';
        $companyCost->companycost_yearly = '456';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Spotify Premium Morrebank';
        $companyCost->companycost_yearly = '144';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Misc Repairs Vehicles/Maintenance';
        $companyCost->companycost_yearly = '2000';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Internet -Hosting -Marketing';
        $companyCost->companycost_yearly = '8400';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Accountant Fee';
        $companyCost->companycost_yearly = '4500';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Sydney FC';
        $companyCost->companycost_yearly = '1368';
        $companyCost->save();

        $companyCost = new App\CompanyCost();
        $companyCost->companycost_name = 'Client Outings - Breakfast/Lunch/Dinner';
        $companyCost->companycost_yearly = '5000';
        $companyCost->save();
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
