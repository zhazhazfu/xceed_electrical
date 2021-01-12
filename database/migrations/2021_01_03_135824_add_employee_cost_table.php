<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployeeCostTable extends Migration
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
            $table->double('employee_hoursperweek')->default(0);
            $table->double('employee_weeksperyear')->default(0);
            $table->double('employee_vehiclecost')->default(0);
            $table->double('employee_otherweeklycost')->default(0);
            $table->double('employee_cash')->default(0);
            $table->double('employee_phone')->default(0);
            $table->double('employee_workercomp')->default(0);
            $table->tinyInteger('employee_archived')->default(0);
            $table->timestamps();
        });

        $employeeCost = new App\EmployeeCost();
        $employeeCost->employee_name = 'Joshua';
        $employeeCost->employee_type = 'Employee';
        $employeeCost->employee_basehourly = '16';
        $employeeCost->employee_hoursperweek = '40';
        $employeeCost->employee_weeksperyear = '52';
        $employeeCost->employee_workercomp = '500';
        $employeeCost->save();

        $employeeCost = new App\EmployeeCost();
        $employeeCost->employee_name = 'Jarryd';
        $employeeCost->employee_type = 'Employee';
        $employeeCost->employee_basehourly = '17';
        $employeeCost->employee_hoursperweek = '40';
        $employeeCost->employee_weeksperyear = '52';
        $employeeCost->save();

        $employeeCost = new App\EmployeeCost();
        $employeeCost->employee_name = 'Tommy';
        $employeeCost->employee_type = 'Sub-Contractor';
        $employeeCost->employee_basehourly = '44';
        $employeeCost->employee_hoursperweek = '40';
        $employeeCost->employee_weeksperyear = '46';
        $employeeCost->save();

        $employeeCost = new App\EmployeeCost();
        $employeeCost->employee_name = 'Jacqui';
        $employeeCost->employee_type = 'Sub-Contractor';
        $employeeCost->employee_basehourly = '30';
        $employeeCost->employee_hoursperweek = '22';
        $employeeCost->employee_weeksperyear = '46';
        $employeeCost->save();
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
