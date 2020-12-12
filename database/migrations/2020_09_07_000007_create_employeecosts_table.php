<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeecostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employeecosts', function (Blueprint $table) {
            $table->id('pk_employee_id');
            $table->string('employee_name');
            $table->string('employee_type');
            $table->double('employee_basehourly')->default(0);
            $table->double('employee_vehiclecost')->default(0);
            $table->double('employee_otherweeklycost')->default(0);
            $table->double('employee_cash')->default(0);
            $table->double('employee_phone')->default(0);
            $table->double('employee_workercomp')->default(0);
            $table->tinyInteger('employee_archived');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employeecosts');
    }
}
