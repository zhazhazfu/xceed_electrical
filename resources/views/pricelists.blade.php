@extends('layouts.app')

@section('title', 'Price List')

@section('content')


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

<!-- total running cost -->
@php
$total_business_hourly_cost = $total + $total_employee + $total_subcontractor;
@endphp


<!-- Button trigger modal -->
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

    <!-- Add product button -->
    <button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal" data-target="#itemModal">
        Add Product
    </button>

    <!-- Active/Archived buttons -->
    <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
        <label class="btn btn-secondary active">
            <input type="radio" name="options" id="active" autocomplete="off" checked> Active
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="options" id="archived" autocomplete="off"> Archived
        </label>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="itemModal" tabindex="-1" role="dialog" aria-labelledby="itemModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="itemModalLabel">Enter product details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ url('pricelists') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="item_archived" value="0">
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Item #</label>
                                <input type="text" class="form-control" id="item_number" name="item_number"
                                    placeholder="ELI-001">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Job Type</label>
                                <select class="form-control" id="item_jobtype" name="item_jobtype">
                                    <option selected>Service Call</option>
                                    <option>Maintenance Repairs</option>
                                    <option>Installation Job</option>
                                    <option>Project Job</option>
                                    <option>Emergency Call Out</option>
                                    <option>After Hours Labour</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Select subcategory</label>
                                <select class="form-control" id="fk_subcategory_id" name="fk_subcategory_id">
                                    @foreach($subCategories as $subCategory)
                                    <option value="{{ $subCategory -> pk_subcategory_id }}">
                                        {{ $subCategory -> subcategory_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Job description</label>
                                <input type="text" class="form-control" id="item_description" name="item_description"
                                    placeholder="E.g. Attend, supply and install..">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Select material</label>
                                <select class="form-control" id="fk_material_id" name="fk_material_id">
                                    @foreach($materials as $material)
                                    <option selected value="{{ $material -> pk_material_id }}">
                                        {{ $material -> material_description}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Estimated time (h)</label>
                                <select class="form-control" id="item_estimatedtime" name="item_estimatedtime">
                                    <option selected>0.00</option>
                                    <option>0.17</option>
                                    <option>0.25</option>
                                    <option>0.33</option>
                                    <option>0.42</option>
                                    <option>0.50</option>
                                    <option>0.57</option>
                                    <option>0.67</option>
                                    <option>0.75</option>
                                    <option>0.83</option>
                                    <option>0.92</option>
                                    <option>1.00</option>
                                    <option>1.25</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Service call</label>
                                <label class="sr-only" for="inlineFormInputGroup">Service call</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" id="item_servicecall"
                                        name="item_servicecall" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Product</button>
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
                <p class="h2">{{$categoryName}} items</p>
            </div>
            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="active_input" onkeyup="activeFunction()"
                    placeholder="Search Item ID">
            </div>
        </div>
        <div class='table-responsive'>
            <table id="active_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortActive(0)">Item #</th>
                        <th scope="col" onclick="sortActive(1)">Job Type</th>
                        <th scope="col" onclick="sortActive(2)">Sub-Category</th>
                        <th scope="col" onclick="sortActive(3)">Description</th>
                        <th scope="col" onclick="sortActive(4)">Materials</th>
                        <th scope="col" onclick="sortActive(5)">Total Charge</th>
                        <th scope="col">Pricing</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subCategories as $subCategory)
                    @foreach($subCategory->priceLists as $priceList)
                    @if($priceList->item_archived == '0')
                    <tr>
                        <td>{{ $priceList->item_number }}</td>
                        <td>{{ $priceList->item_jobtype }}</td>
                        <td>{{ $priceList->subCategory->subcategory_name }}</td>
                        <td>{{ $priceList->item_description }}</td>
                        <td>{{ $priceList->material->material_description }}</td>
                        @foreach ($grossMargins as $grossMargin)
                        <td>${{ number_format((($priceList->material->material_cost*$grossMargin->gm_rate) + $priceList->item_servicecall + $priceList->item_estimatedtime * $total_business_hourly_cost * ($grossMargin->gm_rate /365/8))*1.1,2) }}
                        </td>
                        @endforeach
                        <td>
                            <a href data-toggle="modal" data-target="#exampleModal{{ $priceList->pk_item_id }}">
                                Pricing
                            </a>
                        </td>
                        <td>
                            <a href="{{url('/pricelists/'.$page_id.'/'.$priceList['pk_item_id'].'/edit')}}">Edit</a>
                        </td>
                    </tr>

                    <!-- active pricing modal -->

                    <div class="modal fade" id="exampleModal{{ $priceList->pk_item_id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ $priceList->item_number }} |
                                        {{ $priceList->item_description }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-row pb-2">
                                        <div class="form-group col-md-4">
                                            <label for="input">Material Cost</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Material Cost</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="materialCost"
                                                    value="{{ number_format($priceList->material->material_cost,2) }}"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="input">Gross Margin</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Gross Margin</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">x</div>
                                                </div>
                                                @foreach ($grossMargins as $grossMargin)
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="grossMargin" value="{{$grossMargin->gm_rate}}" disabled>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="input">Material Charge</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Material Charge</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="materialCharge"
                                                    value="{{ number_format($priceList->material->material_cost*$grossMargin->gm_rate,2) }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row pb-2">
                                        <div class="form-group col-md-4">
                                            <label for="input">Charge Rate</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Charge Rate</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                @foreach ($grossMargins as $grossMargin)
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="chargeRate"
                                                    value="{{ number_format($total_business_hourly_cost * $grossMargin->gm_rate /365/8,2) }}"
                                                    disabled>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="input">Estimated Time</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Estimated Time</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">x</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="estimatedTime"
                                                    value="{{ $priceList->item_estimatedtime }} hours" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="input">Labour Charge</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Labour Charge</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="labourCharge"
                                                    value="{{ number_format($priceList->item_estimatedtime * $total_business_hourly_cost * ($grossMargin->gm_rate /365/8),2) }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row pb-2 border-bottom">
                                        <div class="form-group col-md-8">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="input">Service Call Charge</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Service Call
                                                Charge</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="serviceCallCharge"
                                                    value="${{number_format($priceList->item_servicecall,2) }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row pb-2 pt-4">
                                        <div class="form-group col-md-4">
                                            <label for="input">Price</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Price</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="price"
                                                    value="{{ number_format(($priceList->material->material_cost*$grossMargin->gm_rate) + $priceList->item_servicecall + $priceList->item_estimatedtime * $total_business_hourly_cost * ($grossMargin->gm_rate /365/8),2) }}"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="input">GST</label>
                                            <label class="sr-only" for="inlineFormInputGroup">GST</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="gst"
                                                    value="{{ number_format((($priceList->material->material_cost*$grossMargin->gm_rate) + $priceList->item_servicecall + $priceList->item_estimatedtime * $total_business_hourly_cost * ($grossMargin->gm_rate /365/8))*0.1,2) }}"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="input">Price Inc GST</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Price Inc GST</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="priceIncGst"
                                                    value="{{ number_format((($priceList->material->material_cost*$grossMargin->gm_rate) + $priceList->item_servicecall + $priceList->item_estimatedtime * $total_business_hourly_cost * ($grossMargin->gm_rate /365/8))*1.1,2) }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>

    <!-- Archived content -->
    <div id="archived_div" style="display: none">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Archived {{$categoryName}} items</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="archived_input" onkeyup="archivedFunction()"
                    placeholder="Search Item ID">
            </div>
        </div>
        <div class='table-responsive'>
            <table id="archived_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                    <tr>
                        <th scope="col" onclick="sortArchived(0)">Item #</th>
                        <th scope="col" onclick="sortArchived(1)">Job Type</th>
                        <th scope="col" onclick="sortArchived(2)">Sub-Category</th>
                        <th scope="col" onclick="sortArchived(3)">Description</th>
                        <th scope="col" onclick="sortArchived(4)">Materials</th>
                        <th scope="col" onclick="sortArchived(5)">Total Charge</th>
                        <th scope="col">Pricing</th>
                        <th scope="col">Edit</th>
                    </tr>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subCategories as $subCategory)
                    @foreach($subCategory->priceLists as $priceList)
                    @if($priceList->item_archived == '1')
                    <tr>
                        <td>{{ $priceList->item_number }}</td>
                        <td>{{ $priceList->item_jobtype }}</td>
                        <td>{{ $priceList->subCategory->subcategory_name }}</td>
                        <td>{{ $priceList->item_description }}</td>
                        <td>{{ $priceList->material->material_description }}</td>
                        @foreach ($grossMargins as $grossMargin)
                        <td>${{ number_format((($priceList->material->material_cost*$grossMargin->gm_rate) + $priceList->item_servicecall + $priceList->item_estimatedtime * $total_business_hourly_cost * ($grossMargin->gm_rate /365/8))*1.1,2) }}
                        </td>
                        @endforeach
                        <td>
                            <a href data-toggle="modal" data-target="#exampleModal2{{ $priceList->pk_item_id }}">
                                Pricing
                            </a>
                        </td>
                        <td>
                            <a href="{{url('/pricelists/'.$page_id.'/'.$priceList['pk_item_id'].'/edit')}}">Edit</a>
                        </td>
                    </tr>
                    
                    <!-- archived pricing modal -->
                    <div class="modal fade" id="exampleModal2{{ $priceList->pk_item_id }}" tabindex="-1"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ $priceList->item_number }} |
                                        {{ $priceList->item_description }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="form-row pb-2">
                                        <div class="form-group col-md-4">
                                            <label for="input">Material Cost</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Material Cost</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="materialCost"
                                                    value="{{ number_format($priceList->material->material_cost,2) }}"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="input">Gross Margin</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Gross Margin</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">x</div>
                                                </div>
                                                @foreach ($grossMargins as $grossMargin)
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="grossMargin" value="{{$grossMargin->gm_rate}}" disabled>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="input">Material Charge</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Material Charge</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="materialCharge"
                                                    value="{{ number_format($priceList->material->material_cost*$grossMargin->gm_rate,2) }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row pb-2">
                                        <div class="form-group col-md-4">
                                            <label for="input">Charge Rate</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Charge Rate</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                @foreach ($grossMargins as $grossMargin)
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="chargeRate"
                                                    value="{{ number_format($total_business_hourly_cost * $grossMargin->gm_rate /365/8,2) }}"
                                                    disabled>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="input">Estimated Time</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Estimated Time</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">x</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="estimatedTime"
                                                    value="{{ $priceList->item_estimatedtime }} hours" disabled>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="input">Labour Charge</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Labour Charge</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="labourCharge"
                                                    value="{{ number_format($priceList->item_estimatedtime * $total_business_hourly_cost * ($grossMargin->gm_rate /365/8),2) }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row pb-2 border-bottom">
                                        <div class="form-group col-md-8">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="input">Service Call Charge</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Service Call
                                                Charge</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="serviceCallCharge"
                                                    value="${{number_format($priceList->item_servicecall,2) }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row pb-2 pt-4">
                                        <div class="form-group col-md-4">
                                            <label for="input">Price</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Price</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="price"
                                                    value="{{ number_format(($priceList->material->material_cost*$grossMargin->gm_rate) + $priceList->item_servicecall + $priceList->item_estimatedtime * $total_business_hourly_cost * ($grossMargin->gm_rate /365/8),2) }}"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="input">GST</label>
                                            <label class="sr-only" for="inlineFormInputGroup">GST</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="gst"
                                                    value="{{ number_format((($priceList->material->material_cost*$grossMargin->gm_rate) + $priceList->item_servicecall + $priceList->item_estimatedtime * $total_business_hourly_cost * ($grossMargin->gm_rate /365/8))*0.1,2) }}"
                                                    disabled>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="input">Price Inc GST</label>
                                            <label class="sr-only" for="inlineFormInputGroup">Price Inc GST</label>
                                            <div class="input-group mb-2">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">$</div>
                                                </div>
                                                <input type="text" class="form-control" id="inlineFormInputGroup"
                                                    name="priceIncGst"
                                                    value="{{ number_format((($priceList->material->material_cost*$grossMargin->gm_rate) + $priceList->item_servicecall + $priceList->item_estimatedtime * $total_business_hourly_cost * ($grossMargin->gm_rate /365/8))*1.1,2) }}"
                                                    disabled>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@stop
