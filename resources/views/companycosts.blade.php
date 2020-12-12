@extends('layouts.app')

@section('title', 'Company Costs')

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

    <!-- Add companycost button -->
    <button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal" data-target="#fullemployeeModal">
        Add Expense
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

    <!-- companycost modal -->
    <div class="modal fade" id="fullemployeeModal" tabindex="-1" role="dialog" aria-labelledby="fullemployeeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullemployeeModalLabel">Add new expense</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ url('companycosts') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="companycost_archived" value="0">
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Expense name</label>
                                <input type="text" class="form-control" name="companycost_name"
                                    placeholder="Enter expense name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Yearly Cost</label>
                                <label class="sr-only" for="inlineFormInputGroup">Yearly cost</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup"
                                        name="companycost_yearly" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="Submit" class="btn btn-primary">Save Expense</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End modal -->

    <!-- Active content -->
    <div id="active_div">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Company costs</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="active_input" onkeyup="activeFunction()"
                    placeholder="Search company costs">
            </div>
        </div>

        <div class='table-responsive'>
            <table id="active_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortArchived(0)">Expense Name</th>
                        <th scope="col" onclick="sortArchived(1)">Weekly Cost</th>
                        <th scope="col" onclick="sortArchived(2)">Monthly Cost</th>
                        <th scope="col" onclick="sortArchived(3)">Yearly Cost</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $total_package=0;
                    @endphp

                    @foreach($companyCosts as $companyCost)
                    @if($companyCost->companycost_archived == '0')
                    <tr>
                        <td>{{$companyCost->companycost_name}}</td>
                        <td>${{number_format($companyCost->companycost_yearly/52,2)}}</td>
                        <td>${{number_format($companyCost->companycost_yearly/12,2)}}</td>
                        <td>${{number_format($companyCost->companycost_yearly,2)}}</td>
                        <td><a
                                href="{{action('CompanyCostController@edit', $companyCost['pk_companycost_id'])}}">Edit</a>
                        </td>
                    </tr>

                    @php
                    $total_package += $companyCost->companycost_yearly;
                    @endphp

                    @endif
                    @endforeach



                    <tr class="font-weight-bold">
                        <th>Total</th>
                        <td>${{number_format($total_package/52,2)}}</td>
                        <td>${{number_format($total_package/12,2)}}</td>
                        <td>${{number_format($total_package,2)}}</td>
                        <td></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

    <!-- Archived content -->
    <div id="archived_div" style="display: none">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Archived company costs</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="archived_input" onkeyup="archivedFunction()"
                    placeholder="Search company costs">
            </div>
        </div>

        <div class='table-responsive'>
            <table id="archived_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortArchived(0)">Expense Name</th>
                        <th scope="col" onclick="sortArchived(1)">Weekly Cost</th>
                        <th scope="col" onclick="sortArchived(2)">Monthly Cost</th>
                        <th scope="col" onclick="sortArchived(3)">Yearly Cost</th>

                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companyCosts as $companyCost)
                    @if($companyCost->companycost_archived == '1')
                    <tr>
                        <td>{{$companyCost->companycost_name}}</td>
                        <td>${{number_format($companyCost->companycost_yearly/52,2)}}</td>
                        <td>${{number_format($companyCost->companycost_yearly/12,2)}}</td>
                        <td>${{number_format($companyCost->companycost_yearly,2)}}</td>
                        <td><a
                                href="{{action('CompanyCostController@edit', $companyCost['pk_companycost_id'])}}">Edit</a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@stop
