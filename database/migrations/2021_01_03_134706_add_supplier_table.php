<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSupplierTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id('pk_supplier_id');
            $table->string('supplier_companyname');
            $table->string('supplier_contactname')->nullable();
            $table->string('supplier_phone')->nullable();
            $table->string('supplier_email')->nullable();
            $table->tinyInteger('supplier_archived')->default(0);
            $table->timestamps();
        });


        $supplier = new App\Supplier();
        $supplier->supplier_companyname = 'No Supplier';
        $supplier->save();

        $supplier = new App\Supplier();
        $supplier->supplier_companyname = 'Estimate Supplier';
        $supplier->save();

        $supplier = new App\Supplier();
        $supplier->supplier_companyname = 'John R Turk';
        $supplier->save();

        $supplier = new App\Supplier();
        $supplier->supplier_companyname = 'Awesim Electrical Wholesalers';
        $supplier->save();

        $supplier = new App\Supplier();
        $supplier->supplier_companyname = 'TLE Electrical';
        $supplier->save();

        $supplier = new App\Supplier();
        $supplier->supplier_companyname = 'Micron Security';
        $supplier->save();

        $supplier = new App\Supplier();
        $supplier->supplier_companyname = 'Rhino Security';
        $supplier->save();

        $supplier = new App\Supplier();
        $supplier->supplier_companyname = 'Secutech Security Supplies';
        $supplier->save();

        $supplier = new App\Supplier();
        $supplier->supplier_companyname = 'LSC Security Supplies';
        $supplier->save();

        $supplier = new App\Supplier();
        $supplier->supplier_companyname = 'Alloys';
        $supplier->save();

        $supplier = new App\Supplier();
        $supplier->supplier_companyname = 'DHS - Automation Supplies';
        $supplier->save();

        $supplier = new App\Supplier();
        $supplier->supplier_companyname = 'Smart Home - Automation Supplies';
        $supplier->save();

        $supplier = new App\Supplier();
        $supplier->supplier_companyname = 'Bunnings Warehouse';
        $supplier->save();
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
