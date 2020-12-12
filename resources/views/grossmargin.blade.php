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



    <!-- Add Modal -->
    <div class="modal fade" id="addGmModal" tabindex="-1" role="dialog" aria-labelledby="addGmModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addGmModalLabel">Edit GM rate</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ url('grossmargin') }}">
                        {{ csrf_field() }}
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Gross margin rate</label>
                                <label class="sr-only" for="inlineFormInputGroup">Gross margin rate</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">%</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup" name="add_gm_rate"
                                        placeholder="Gross margin rate">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="Submit" class="btn btn-primary">Add GM rate</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="gmModal" tabindex="-1" role="dialog" aria-labelledby="gmModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="gmModalLabel">Edit GM rate</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{action('GrossMarginController@update', 'gm_rate')}}">
                        {{ csrf_field() }}
                        <input type="hidden" name="_method" value="PATCH">
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Gross margin rate</label>
                                <label class="sr-only" for="inlineFormInputGroup">Gross margin rate</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">%</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup" name="gm_rate"
                                        placeholder="Gross margin rate">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="Submit" class="btn btn-primary">Update GM rate</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div class='table-responsive'>
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">Hourly running cost</th>
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
                        @foreach($grossmargin as $grossmargin)
                        {{ $grossmargin->gm_rate }}
                        @endforeach
                    </td>
                    <td>
                        ${{ number_format($total_business_hourly_cost/365/8 * $grossmargin->gm_rate,2) }}
                    </td>
                    <td><a href="{{action('GrossMarginController@edit', $grossmargin['pk_gm_id'])}}">Edit</a></td>

                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class=" p-3 mb-5 bg-white rounded border">

    <p class=" h3 mb-4 float-left">Gross margin calculation</p>


    <div class='table-responsive'>
        <table class="table table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col">Hourly running cost</th>
                    <th scope="col">Gross margin rate</th>
                    <th scope="col">Hourly charge rate</th>
                </tr>
            </thead>
            <tbody>
                @php
                $grossMargins=array(1.111,1.143,1.176,1.25,1.29,1.333,1.379,1.429,1.481,1.4925,1.538,1.6,1.667,1.739,1.818,1.905,2,2.1092,2.223,2.3529,2.5,2.666,2.852,3.075,3.333,4,5,6.667)
                @endphp
                @foreach ($grossMargins as $grossMargin)
                <tr>
                    <td>
                    ${{ number_format($total_business_hourly_cost/365/8,2) }}
                    </td>
                    <td>{{$grossMargin}}</td>
                    <td>
                        ${{number_format($grossMargin * ($total_business_hourly_cost/365/8),2) }}
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endif
@stop
