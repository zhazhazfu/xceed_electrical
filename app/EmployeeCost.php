<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class EmployeeCost extends Model
{
    protected $table = 'employeecosts';
    protected $primaryKey = 'pk_employee_id';
    protected $fillable = [
            'employee_name', 
            'employee_basehourly',
            'employee_hoursperweek',
            'employee_weeksperyear',
            'employee_vehiclecost',
            'employee_otherweeklycost',
            'employee_cash',
            'employee_phone',
            'employee_workercomp',
            'employee_type',
            'employee_archived'
        ];

}
