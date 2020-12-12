@extends('layouts.app')

@section('title', 'Total Business & Employee Costs')

@section('content')
@if (Auth::user() && Auth::user()->role != 'admin')
<div class="mx-auto mt-5" style="width: 200px;">
    <h2>
        Access denied
    </h2>
</div>

@elseif (Auth::user() && Auth::user()->role == 'admin')
<div class=" p-3 mb-5 bg-white number_formated border">
    <h2 class="mb-4 float-left">Total Business & Employee Costs</h2>
    <div class='table-responsive'>
        <table class="table table-hover table-sm mt-1">
            <thead>
                <tr>
                    <th scope="col">Category</th>
                    <th scope="col">Hourly Cost</th>
                    <th scope="col">Daily Cost</th>
                    <th scope="col">Weekly Cost</th>
                    <th scope="col">Monthly Cost</th>
                    <th scope="col">Yearly Cost</th>


                </tr>
            </thead>
            <tbody>

            <!-- total company expenses -->
                @php
                $total = 0;
                @endphp
                @foreach($companyCosts as $companyCost)
                @if($companyCost->companycost_archived == '0')
                @php
                $total += $companyCost->companycost_yearly;
                @endphp
                @endif
                @endforeach

                <tr>
                    <td>Company Expenses</td>
                    <td>${{number_format(($total/365)/8,2)}}</td>
                    <td>${{number_format($total/365,2)}}</td>
                    <td>${{number_format(($total/365)*7,2)}}</td>
                    <td>${{number_format($total/12.935705,2)}}</td>
                    <td>${{number_format($total,2)}}</td>


                </tr>




                <!-- total employee costs -->
                @php
                $total_employee = 0;
                $total_cost_less_super=0;
                @endphp
                @foreach($employeeCosts as $employeeCost)
                @if($employeeCost->employee_archived == '0' && $employeeCost->employee_type == 'Employee')
                @php
                $total_employee += $employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 +
                $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost +
                $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear;
                $total_cost_less_super+=$employeeCost->employee_workercomp +
                $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
                $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone
                +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost +
                $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
                $employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095;
                @endphp
                @endif
                @endforeach
                <tr>
                    <td>Employees</td>
                    <td>${{number_format(($total_employee/365)/8,2)}}</td>
                    <td>${{number_format($total_employee/365,2)}}</td>
                    <td>${{number_format(($total_employee/365)*7,2)}}</td>
                    <td>${{number_format($total_employee/12.935705,2)}}</td>
                    <td>${{number_format($total_employee,2)}}</td>
                </tr>

                <!-- total sub-contractor costs -->
                @php
                $total_subcontractor = 0;
                $total_cost_less_super=0;
                @endphp
                @foreach($employeeCosts as $employeeCost)
                @if($employeeCost->employee_archived == '0' && $employeeCost->employee_type == 'Sub-Contractor')
                @php
                $total_subcontractor += $employeeCost->employee_cash + $employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 +
                $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost +
                $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear;
                $total_cost_less_super+=$employeeCost->employee_workercomp +
                $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
                $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone
                +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost +
                $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
                $employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek*
                $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095;
                @endphp
                @endif
                @endforeach
                <tr>
                    <td>Sub-Contractors</td>
                    <td>${{number_format(($total_subcontractor/365)/8,2)}}</td>
                    <td>${{number_format($total_subcontractor/365,2)}}</td>
                    <td>${{number_format(($total_subcontractor/365)*7,2)}}</td>
                    <td>${{number_format($total_subcontractor/12.935705,2)}}</td>
                    <td>${{number_format($total_subcontractor,2)}}</td>
                </tr>

                <tr class="font-weight-bold">

                    <td>Total</td>
                    <td>${{number_format(($total + $total_employee + $total_subcontractor)/365/8,2)}}</td>
                    <td>${{number_format(($total + $total_employee + $total_subcontractor)/365,2)}}</td>
                    <td>${{number_format((($total + $total_employee + $total_subcontractor)/365)*7,2)}}</td>
                    <td>${{number_format(($total + $total_employee + $total_subcontractor)/12.935705,2)}}</td>
                    <td>${{number_format($total + $total_employee + $total_subcontractor,2)}}</td>



                </tr>
            </tbody>
        </table>
    </div>
</div>
@endif
@stop
