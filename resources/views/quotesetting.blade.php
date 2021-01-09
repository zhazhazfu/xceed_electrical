@extends('layouts.app')

@section('title', 'Quote Setting')

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
        Add Terms & Condition
    </button>

    <!-- Full Employee Modal -->
    <div class="modal fade" id="fullemployeeModal" tabindex="-1" role="dialog" aria-labelledby="fullemployeeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="fullemployeeModalLabel">Enter terms and conditions</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="get" action="{{ url('quotesetting') }}">
                        {{ csrf_field() }}
                    
                        <div class="form-row">

                            <div class="form-group col-md-6">
                                <label for="input">T&C ID</label>
                                <label class="sr-only" for="inlineFormInputGroup">Vehicle</label>
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control" id="inlineFormInputGroup"
                                        name="termsandconditions">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="input">Description</label>
                                <label class="sr-only" for="inlineFormInputGroup">Other costs</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                    </div>
                                    <input type="text" class="form-control" id="inlineFormInputGroup"
                                        name="termsandconditionsdesc">
                                </div>
                            </div>
                            @foreach($quoteterms as $QuoteTerm)
                            <option value="{{ $quoteterms -> pk_term_id }}">
                                {{ $quoteterms -> term_name }}
                            </option>
                            @endforeach
                        </div>
                        
                </div>
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="Submit" class="btn btn-primary">Save Terms & Condition</button>
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
                <p class="h2">Terms & Conditions</p>
            </div>

        </div>

        <div class='table-responsive'>
            <table id="active_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortActive(0)">Terms & Conditions</th>
                        <th scope="col" onclick="sortActive(1)">Description</th>
                    </tr>
                </thead>
                <tbody>

                    <tr class="font-weight-bold">
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
                        {{-- <td>${{number_format($total_package,2)}}</td> --}}
                        {{-- <td>${{number_format($total_cost_less_super,2)}}</td> --}}
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
        </div>
        <div class='table-responsive'>
            <table id="archived_table" class="display table table-hover table-sm">
                <thead>
                 
                </thead>
                <tbody>
                  
                    <tr class="font-weight-bold">
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
                        {{-- <td>${{number_format($total_package,2)}}</td> --}}
                        {{-- <td>${{number_format($total_cost_less_super,2)}}</td> --}}
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
        Add Inclusion
    </button>

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
                <p class="h2">Inclusions</p>
            </div>
        </div>
        <div class='table-responsive'>
            <table id="active_table2" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortActive2(0)">Inclusion</th>
                        <th scope="col" onclick="sortActive2(1)">Description</th>
                    </tr>
                </thead>
                <tbody>
                    </tr>
                    <tr class="font-weight-bold">
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
                        {{-- <td>${{number_format($total_package,2)}}</td> --}}
                        <td></td>
                        <td></td>
                        {{-- <td>${{number_format($total_cost_less_super,2)}}</td> --}}
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>



        </div>
        <div class='table-responsive'>
            <table id="archived_table2" class="display table table-hover table-sm">
                <thead>
                    <tr>
  
                    </tr>
                </thead>
                <tbody>
                    <tr class="font-weight-bold">
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
                        {{-- <td>${{number_format($total_package,2)}}</td> --}}
                        <td></td>
                        <td></td>
                        {{-- <td>${{number_format($total_cost_less_super,2)}}</td> --}}
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>
            <div id="archived_div" style="display: none">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Inclusions</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-left">
                    @foreach($inclusions as $Inclusions)
                    <option value="{{ $Inclusions -> pk_in_id }}">
                        {{ $Inclusions -> inclusion_title }}
                    </option>
                    @endforeach
            </div>
        </div>
        <div class='table-responsive'>
            <table id="archived_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortArchived(0)">Name</th>
                        <th scope="col" onclick="sortArchived(1)">Hourly</th>
                    </tr>
                </thead>
                <tbody>
                  
                    <tr class="font-weight-bold">
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
                        {{-- <td>${{number_format($total_package,2)}}</td> --}}
                        {{-- <td>${{number_format($total_cost_less_super,2)}}</td> --}}
                        <td></td>
                    </tr>
                </tbody>
            </table>
        </div>

        
    </div>
    </div>
    
</div>

<div class=" p-3 mb-5 bg-white rounded border">

    <button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal"
    data-target="#subcontractorModal">
    Add Exclusion
</button>
  <!-- Sub-contractor active content -->
  <div id="active_div2">
    <div class="row mb-4">
        <div class="col-sm-7">
            <p class="h2">Exclusions</p>
        </div>
    </div>
    <div class='table-responsive'>
        <table id="active_table2" class="display table table-hover table-sm">
            <thead>
                <tr>
                    <th scope="col" onclick="sortActive2(0)">Exclusion</th>
                    <th scope="col" onclick="sortActive2(1)">Description</th>
                </tr>
            </thead>
            <tbody>
                </tr>
                <tr class="font-weight-bold">
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
                    {{-- <td>${{number_format($total_package,2)}}</td> --}}
                    <td></td>
                    <td></td>
                    {{-- <td>${{number_format($total_cost_less_super,2)}}</td> --}}
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


@endif
@stop
