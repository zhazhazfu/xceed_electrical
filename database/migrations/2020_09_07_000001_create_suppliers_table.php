<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
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
        $supplier->supplier_companyname = 'Estimate Supplier';
        $supplier->supplier_contactname = 'Assign materials for estimations to me';
        $supplier->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suppliers');
    }
}
