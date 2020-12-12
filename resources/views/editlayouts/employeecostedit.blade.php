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
<div class="p-3 rounded border">
    <div class="row">
        <div class="col-sm">
            <h3>Edit Employee Cost</h3>
            <form method="post" action="{{action('EmployeeCostController@update', $pk_employee_id)}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Employee name</label>
                        <input type="text" class="form-control" id="employee_name" name="employee_name"
                            value="{{$employeeCosts->employee_name}}">
                    </div>
                    <div class="form-group col-sm">
                        <label for="input">Base hourly</label>
                        <input type="text" class="form-control" id="employee_basehourly" name="employee_basehourly"
                            value="{{$employeeCosts->employee_basehourly}}">
                    </div>
                </div>
                <div class="form-row border-bottom pb-2">
                    <div class="form-group col-md-6">
                        <label for="input">Hours per week</label>
                        <input type="text" class="form-control" id="hoursPerWeek" name="employee_hoursperweek"
                            value="{{$employeeCosts->employee_hoursperweek}}">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="input">Weeks per year</label>

                        <div class="input-group mb-2">
                            <input type="text" class="form-control" id="weeksPerYear" name="employee_weeksperyear"
                                value="{{$employeeCosts->employee_weeksperyear}}">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Vehicle</label>
                        <input type="text" class="form-control" id="employee_vehiclecost" name="employee_vehiclecost"
                            value="{{$employeeCosts->employee_vehiclecost}}">
                    </div>
                    <div class="form-group col-sm">
                        <label for="input">Other costs</label>
                        <input type="text" class="form-control" id="inputEmail" name="employee_otherweeklycost"
                            value="{{$employeeCosts->employee_otherweeklycost}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Phone</label>
                        <input type="text" class="form-control" id="inputAddress" name="employee_phone"
                            value="{{$employeeCosts->employee_phone}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Workers comp</label>
                        <input type="text" class="form-control" id="inputAddress" name="employee_workercomp"
                            value="{{$employeeCosts->employee_workercomp}}">
                    </div>
                </div>
                @if ($employeeCosts->employee_type == 'Sub-Contractor')
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Cash</label>
                        <input type="text" class="form-control" id="inputAddress" name="employee_cash"
                            value="{{$employeeCosts->employee_cash}}">
                    </div>
                </div>
                @else
                <input type="hidden" name="employee_cash" value="0">
                @endif
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Archived</label>
                        <select id="employee_archived" name="employee_archived" class="form-control">
                            @if ($employeeCosts->employee_archived == 0)
                            <option value="0" selected>No</option>
                            <option value="1">Yes</option>
                            @else
                            <option value="0">No</option>
                            <option value="1" selected>Yes</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <a class="btn btn-secondary" href="{{url('/employeecosts')}}">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@stop
