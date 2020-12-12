<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmployeeHoursperweekWeeksperyearColumnsToEmployeecosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employeecosts', function (Blueprint $table) {
            $table->double('employee_hoursperweek')->after('employee_basehourly');
            $table->double('employee_weeksperyear')->after('employee_hoursperweek');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employeecosts', function (Blueprint $table) {
            $table->dropColumn('employee_hoursperweek');
            $table->dropColumn('employee_weeksperyear');
        });
    }
}
