@extends('layouts.app')

@section('title', 'Gross Margin')

@section('content')
@if (Auth::user() && Auth::user()->role != 'admin')
<div class="mx-auto mt-5" style="width: 200px;">
    <h2>
        Access denied
    </h2>
</div>

@elseif (Auth::user() && Auth::user()->role == 'admin')
<div class=" p-3 mb-5 bg-white rounded border">
    <div>
        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
        @endif
    </div>
    <p class="h3 mb-4 float-left">Current GM Rate</p>

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


    <!-- total sub-contractor costs -->
    @php
    $total_subcontractor = 0;
    $total_cost_less_super=0;
    @endphp
    @foreach($employeeCosts as $employeeCost)
    @if($employeeCost->employee_archived == '0' && $employeeCost->employee_type == 'Sub-Contractor')
    @php
    $total_subcontractor += $employeeCost->employee_cash + $employeeCost->employee_workercomp +
    $employeeCost->employee_hoursperweek*
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


    @php
    $total_business_hourly_cost = $total + $total_employee + $total_subcontractor;
    @endphp



 
    <div class='table-responsive'>
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">Hourly running cost</th>
                    <th scope="col">Gross margin percentage</th>
                    <th scope="col">Gross margin rate</th>
                    <th scope="col">Hourly charge rate</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        ${{ number_format($total_business_hourly_cost/365/8,2) }}
                    </td>

                    <td>
                        @foreach($grossmargin as $grossmargins)
                        @if ($grossmargins->pk_gm_id == $grossmargins->pk_gm_id)
                        {{ $grossmargins->gm_percentage}}
                        @endif
                        @endforeach
                    </td>

                    <td>
                        @foreach($grossmargin as $grossmargins)
                        {{ $grossmargins->gm_rate }}
                        @endforeach
                    </td>
                    <td>
                        {{ number_format($total_business_hourly_cost/365/8 * $grossmargins->gm_rate,2) }}
                    </td>
                    <td><a href="{{action('GrossMarginController@edit', $grossmargins['pk_gm_id'])}}">Edit</a></td>

                </tr>
            </tbody>
        </table>
    </div>
</div> 

@endif
@stop
