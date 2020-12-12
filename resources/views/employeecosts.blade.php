@extends('layouts.app')

@section('title', 'Employee Costs')

@section('content')
@if (Auth::user() && Auth::user()->role != 'admin')
<div class="mx-auto mt-5" style="width: 200px;">
    <h2>
        Access denied
    </h2>
</div>

@elseif (Auth::user() && Auth::user()->role == 'admin')

<!-- Button trigger Employee modal -->
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

    <!-- Add employee button -->
    <button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal" data-target="#fullemployeeModal">
        Add Employee
    </button>

    <!-- Active/archive buttons -->
    <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
        <label class="btn btn-secondary active">
            <input type="radio" name="options" id="active" autocomplete="off" checked> Active
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="options" id="archived" autocomplete="off"> Archived
        </label>
    </div>

    <!-- Full Employee Modal -->
    <div class="modal fade" id="fullemployeeModal" tabindex="-1" role="dialog" aria-labelledby="fullemployeeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullemployeeModalLabel">Enter employee details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ url('employeecosts') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="employee_archived" value="0">
                        <input type="hidden" name="employee_type" value="Employee">
                        <input type="hidden" name="employee_cash" value="0">
                        <div class="form-row pb-2">
                            <div class="form-group col-md-6">
                                <label for="input">Employee name</label>
                                <input type="text" class="form-control" id="employeeName" name="employee_name"
                                    placeholder="John Smith">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input">Base hourly</label>
                                <label class="sr-only" for="inlineFormInputGroup">Base hourly</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup"
                                        name="employee_basehourly" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                        <div class="form-row border-bottom pb-2">
                            <div class="form-group col-md-6">
                                <label for="input">Hours per week</label>
                                <input type="text" class="form-control" id="hoursPerWeek" name="employee_hoursperweek"
                                    placeholder="0">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input">Weeks per year</label>

                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" id="weeksPerYear"
                                        name="employee_weeksperyear" placeholder="0">
                                </div>
                            </div>
                        </div>

                        <h5 class="pt-3 pb-1">Annual expenses</h5>
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="input">Vehicle</label>
                                <label class="sr-only" for="inlineFormInputGroup">Vehicle</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup"
                                        name="employee_vehiclecost" placeholder="0.00" value="0">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input">Other costs</label>
                                <label class="sr-only" for="inlineFormInputGroup">Other costs</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup"
                                        name="employee_otherweeklycost" placeholder="0.00" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input">Phone</label>
                                <label class="sr-only" for="inlineFormInputGroup">Phone</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup"
                                        name="employee_phone" placeholder="0.00" value="0">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input">Workers comp</label>
                                <label class="sr-only" for="inlineFormInputGroup">Workers comp</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup"
                                        name="employee_workercomp" placeholder="0.00" value="0">
                                </div>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="Submit" class="btn btn-primary">Save Employee</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End full employee modal -->

    <!-- Employee active content -->
    <div id="active_div">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Employees</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="active_input" onkeyup="activeFunction()"
                    placeholder="Search employee name">
            </div>
        </div>

        <div class='table-responsive'>
            <table id="active_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortActive(0)">Name</th>
                        <th scope="col" onclick="sortActive(1)">Hourly</th>
                        <th scope="col" onclick="sortActive(2)">Weekly</th>
                        <th scope="col" onclick="sortActive(3)">Yearly</th>
                        <th scope="col" onclick="sortActive(4)">Hours per week</th>
                        <th scope="col" onclick="sortActive(5)">Weeks per year</th>
                        <th scope="col" onclick="sortActive(6)">Vehicle</th>
                        <th scope="col" onclick="sortActive(7)">Other Costs</th>
                        <th scope="col" onclick="sortActive(8)">Phone</th>
                        <th scope="col" onclick="sortActive(9)">Super</th>
                        <th scope="col" onclick="sortActive(10)">Workers Comp</th>
                        <th scope="col" onclick="sortActive(11)">Total Package</th>
                        <th scope="col" onclick="sortActive(12)">Total Cost Less Super</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_package=0;
                    $total_cost_less_super=0;
                    @endphp
                    @foreach($employeeCosts as $employeeCost)
                    @if ($employeeCost->employee_type == 'Employee' && $employeeCost->employee_archived == '0')
                    <tr>
                        <td>{{$employeeCost->employee_name}}</td>

                        <td>${{number_format($employeeCost->employee_basehourly,2)}}</td>
                        <td>${{number_format($employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly,2)}}
                        </td>
                        <td>${{number_format($employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear,2)}}
                        </td>
                        <td>{{number_format($employeeCost->employee_hoursperweek)}}</td>
                        <td>{{number_format($employeeCost->employee_weeksperyear)}}</td>
                        <td>${{number_format($employeeCost->employee_vehiclecost,2)}}</td>
                        <td>${{number_format($employeeCost->employee_otherweeklycost,2)}}</td>
                        <td>${{number_format($employeeCost->employee_phone,2)}}</td>
                        <td>${{number_format($employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095,2)}}
                        </td>
                        <td>${{number_format($employeeCost->employee_workercomp,2)}}</td>
                        <td>${{number_format($employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear,2)}}
                        </td>
                        <td>${{number_format($employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095,2)}}
                        </td>
                        @php
                        $total_package += $employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek*
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
                        <td><a
                                href="{{action('EmployeeCostController@edit', $employeeCost['pk_employee_id'])}}">Edit</a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    <tr class="font-weight-bold">
                        <th>Total</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>${{number_format($total_package,2)}}</td>
                        <td>${{number_format($total_cost_less_super,2)}}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Employee archived content -->
    <div id="archived_div" style="display: none">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Archived Employees</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="archived_input" onkeyup="archivedFunction()"
                    placeholder="Search employee name">
            </div>
        </div>
        <div class='table-responsive'>
            <table id="archived_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortArchived(0)">Name</th>
                        <th scope="col" onclick="sortArchived(1)">Hourly</th>
                        <th scope="col" onclick="sortArchived(2)">Weekly</th>
                        <th scope="col" onclick="sortArchived(3)">Yearly</th>
                        <th scope="col" onclick="sortArchived(4)">Hours per week</th>
                        <th scope="col" onclick="sortArchived(5)">Weeks per year</th>
                        <th scope="col" onclick="sortArchived(6)">Vehicle</th>
                        <th scope="col" onclick="sortArchived(7)">Other Costs</th>
                        <th scope="col" onclick="sortArchived(8)">Phone</th>
                        <th scope="col" onclick="sortArchived(9)">Super</th>
                        <th scope="col" onclick="sortArchived(10)">Workers Comp</th>
                        <th scope="col" onclick="sortArchived(11)">Total Package</th>
                        <th scope="col" onclick="sortArchived(12)">Total Cost Less Super</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_package=0;
                    $total_cost_less_super=0;
                    @endphp
                    @foreach($employeeCosts as $employeeCost)
                    @if ($employeeCost->employee_type == 'Employee' && $employeeCost->employee_archived == '1')
                    <tr>
                        <td>{{$employeeCost->employee_name}}</td>

                        <td>${{number_format($employeeCost->employee_basehourly,2)}}</td>
                        <td>${{number_format($employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly,2)}}
                        </td>
                        <td>${{number_format($employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear,2)}}
                        </td>
                        <td>{{number_format($employeeCost->employee_hoursperweek)}}</td>
                        <td>{{number_format($employeeCost->employee_weeksperyear)}}</td>
                        <td>${{number_format($employeeCost->employee_vehiclecost,2)}}</td>
                        <td>${{number_format($employeeCost->employee_otherweeklycost,2)}}</td>
                        <td>${{number_format($employeeCost->employee_phone,2)}}</td>
                        <td>${{number_format($employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095,2)}}
                        </td>
                        <td>${{number_format($employeeCost->employee_workercomp,2)}}</td>
                        <td>${{number_format($employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear,2)}}
                        </td>
                        <td>${{number_format($employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095,2)}}
                        </td>
                        <td><a
                                href="{{action('EmployeeCostController@edit', $employeeCost['pk_employee_id'])}}">Edit</a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    <tr class="font-weight-bold">
                        <th>Total</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>${{number_format($total_package,2)}}</td>
                        <td>${{number_format($total_cost_less_super,2)}}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class=" p-3 mb-5 bg-white rounded border">

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal"
        data-target="#subcontractorModal">
        Add Sub-Contractor
    </button>

    <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
        <label class="btn btn-secondary active">
            <input type="radio" name="options" id="active2" autocomplete="off" checked> Active
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="options" id="archived2" autocomplete="off"> Archived
        </label>
    </div>

    <!-- Add sub-contractor Modal -->
    <div class="modal fade" id="subcontractorModal" tabindex="-1" role="dialog"
        aria-labelledby="subcontractorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="subcontractorModalLabel">Enter sub-contracator details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="{{ url('employeecosts') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="employee_archived" value="0">
                        <input type="hidden" name="employee_type" value="Sub-Contractor">
                        <div class="form-row pb-2">
                            <div class="form-group col-md-6">
                                <label for="input">Sub-contractor name</label>
                                <input type="text" class="form-control" id="subcontractorName" name="employee_name"
                                    placeholder="John Smith">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input">Hourly rate</label>
                                <label class="sr-only" for="inlineFormInputGroup">Hourly rate</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup"
                                        name="employee_basehourly" placeholder="0.00">
                                </div>
                            </div>
                        </div>

                        <div class="form-row border-bottom pb-2">
                            <div class="form-group col-md-6">
                                <label for="input">Hours per week</label>
                                <input type="text" class="form-control" id="hoursPerWeek" name="employee_hoursperweek"
                                    placeholder="0">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input">Weeks per year</label>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" id="weeksPerYear"
                                        name="employee_weeksperyear" placeholder="0">
                                </div>
                            </div>
                        </div>

                        <h5 class="pt-3 pb-1">Annual expenses</h5>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input">Vehicle</label>
                                <label class="sr-only" for="inlineFormInputGroup">Vehicle</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup"
                                        name="employee_vehiclecost" placeholder="Vehicle" value="0">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input">Other costs</label>
                                <label class="sr-only" for="inlineFormInputGroup">Other costs</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup"
                                        name="employee_otherweeklycost" placeholder="eTag, etc" value="0">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input">Phone</label>
                                <label class="sr-only" for="inlineFormInputGroup">Phone</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup"
                                        name="employee_phone" placeholder="Phone" value="0">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input">Workers comp</label>
                                <label class="sr-only" for="inlineFormInputGroup">Workers comp</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup"
                                        name="employee_workercomp" placeholder="Workers Comp" value="0">
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="input">Cash</label>
                                <label class="sr-only" for="inlineFormInputGroup">Cash</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup"
                                        name="employee_cash" placeholder="Cash" value="0">

                                </div>
                            </div>
                        </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Sub-Contractor</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sub-contractor active content -->
    <div id="active_div2">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Sub-contractors</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="active_input2" onkeyup="activeFunction2()"
                    placeholder="Search sub-contractor name">
            </div>
        </div>
        <div class='table-responsive'>
            <table id="active_table2" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortActive2(0)">Name</th>
                        <th scope="col" onclick="sortActive2(1)">Hourly</th>
                        <th scope="col" onclick="sortActive2(2)">Weekly</th>
                        <th scope="col" onclick="sortActive2(3)">Yearly</th>
                        <th scope="col" onclick="sortActive2(4)">Hours per week</th>
                        <th scope="col" onclick="sortActive2(5)">Weeks per year</th>
                        <th scope="col" onclick="sortActive2(6)">Vehicle</th>
                        <th scope="col" onclick="sortActive2(7)">Other Costs</th>
                        <th scope="col" onclick="sortActive2(8)">Cash</th>
                        <th scope="col" onclick="sortActive2(9)">Phone</th>
                        <th scope="col" onclick="sortActive2(10)">Super</th>
                        <th scope="col" onclick="sortActive2(11)">Workers Comp</th>
                        <th scope="col" onclick="sortActive2(12)">Total Package</th>
                        <th scope="col" onclick="sortActive2(13)">GST</th>
                        <th scope="col" onclick="sortActive2(14)">Total Inc GST</th>
                        <th scope="col" onclick="sortActive2(15)">Total Cost Less Super</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_package=0;
                    $total_cost_less_super=0;
                    @endphp
                    @foreach($employeeCosts as $employeeCost)
                    @if ($employeeCost->employee_type == 'Sub-Contractor' && $employeeCost->employee_archived == '0')
                    <tr>
                        <td>{{$employeeCost->employee_name}}</td>
                        <td>${{number_format($employeeCost->employee_basehourly,2)}}</td>
                        <td>${{number_format($employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly,2)}}
                        </td>
                        <td>${{number_format($employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear,2)}}
                        </td>
                        <td>{{number_format($employeeCost->employee_hoursperweek)}}</td>
                        <td>{{number_format($employeeCost->employee_weeksperyear)}}</td>
                        <td>${{number_format($employeeCost->employee_vehiclecost,2)}}</td>
                        <td>${{number_format($employeeCost->employee_otherweeklycost,2)}}</td>
                        <td>${{number_format($employeeCost->employee_cash,2)}}</td>
                        <td>${{number_format($employeeCost->employee_phone,2)}}</td>
                        <td>${{number_format($employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095,2)}}
                        </td>
                        <td>${{number_format($employeeCost->employee_workercomp,2)}}</td>
                        <td>${{number_format($employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost + $employeeCost->employee_cash + $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear,2)}}
                        </td>
                        <td>${{number_format(($employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear)*10/100,2)}}
                        </td>
                        <td>${{number_format(($employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear)*10/100 + $employeeCost->employee_cash + $employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear,2)}}
                        </td>
                        <td>${{number_format($employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095,2)}}
                        </td>
                        @php
                        $total_package += $employeeCost->employee_cash + $employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek*
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
                        <td><a
                                href="{{action('EmployeeCostController@edit', $employeeCost['pk_employee_id'])}}">Edit</a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    <tr class="font-weight-bold">
                        <th>Total</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>${{number_format($total_package,2)}}</td>
                        <td></td>
                        <td></td>
                        <td>${{number_format($total_cost_less_super,2)}}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Sub-contractor archived content -->
    <div id="archived_div2" style="display: none">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Archived Sub-contractors</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="archived_input2" onkeyup="archivedFunction2()"
                    placeholder="Search sub-contractor name">
            </div>

        </div>
        <div class='table-responsive'>
            <table id="archived_table2" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortArchived2(0)">Name</th>
                        <th scope="col" onclick="sortArchived2(1)">Hourly</th>
                        <th scope="col" onclick="sortArchived2(2)">Weekly</th>
                        <th scope="col" onclick="sortArchived2(3)">Yearly</th>
                        <th scope="col" onclick="sortArchived2(4)">Hours per week</th>
                        <th scope="col" onclick="sortArchived2(5)">Weeks per year</th>
                        <th scope="col" onclick="sortArchived2(6)">Vehicle</th>
                        <th scope="col" onclick="sortArchived2(7)">Other Costs</th>
                        <th scope="col" onclick="sortArchived2(8)">Cash</th>
                        <th scope="col" onclick="sortArchived2(9)">Phone</th>
                        <th scope="col" onclick="sortArchived2(10)">Super</th>
                        <th scope="col" onclick="sortArchived2(11)">Workers Comp</th>
                        <th scope="col" onclick="sortArchived2(12)">Total Package</th>
                        <th scope="col" onclick="sortArchived2(13)">GST</th>
                        <th scope="col" onclick="sortArchived2(14)">Total Inc GST</th>
                        <th scope="col" onclick="sortArchived2(15)">Total Cost Less Super</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_package=0;
                    $total_cost_less_super=0;
                    @endphp
                    @foreach($employeeCosts as $employeeCost)
                    @if ($employeeCost->employee_type == 'Sub-Contractor' && $employeeCost->employee_archived == '1')
                    <tr>
                        <td>{{$employeeCost->employee_name}}</td>
                        <td>${{number_format($employeeCost->employee_basehourly,2)}}</td>
                        <td>${{number_format($employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly,2)}}
                        </td>
                        <td>${{number_format($employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear,2)}}
                        </td>
                        <td>s{{number_format($employeeCost->employee_hoursperweek)}}</td>
                        <td>{{number_format($employeeCost->employee_weeksperyear)}}</td>
                        <td>${{number_format($employeeCost->employee_vehiclecost,2)}}</td>
                        <td>${{number_format($employeeCost->employee_otherweeklycost,2)}}</td>
                        <td>${{number_format($employeeCost->employee_cash,2)}}</td>
                        <td>${{number_format($employeeCost->employee_phone,2)}}</td>
                        <td>${{number_format($employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095,2)}}
                        </td>
                        <td>${{number_format($employeeCost->employee_workercomp,2)}}</td>
                        <td>${{number_format($employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost + $employeeCost->employee_cash + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear,2)}}
                        </td>
                        <td>${{number_format(($employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear)*10/100,2)}}
                        </td>
                        <td>${{number_format(($employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear)*10/100 + $employeeCost->employee_cash + $employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear,2)}}
                        </td>
                        <td>${{number_format($employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone +$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095,2)}}
                        </td>
                        <td><a
                                href="{{action('EmployeeCostController@edit', $employeeCost['pk_employee_id'])}}">Edit</a>
                        </td>
                        @php
                        $total_package += $employeeCost->employee_cash + $employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek*
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
                    </tr>
                    @endif
                    @endforeach
                    <tr class="font-weight-bold">
                        <th>Total</th>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>${{number_format($total_package,2)}}</td>
                        <td></td>
                        <td></td>
                        <td>${{number_format($total_cost_less_super,2)}}</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@stop
