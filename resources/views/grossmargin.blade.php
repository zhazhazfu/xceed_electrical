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
    <p class="h3 mb-4 float-left">Current Gross Margin Rate</p>

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



    <!-- Edit Modal -->
    {{-- <div class="modal fade" id="gmModal" tabindex="-1" role="dialog" aria-labelledby="gmModal" aria-hidden="true">
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
                                     <select id="gm_percentage" name="gm_percentage">
                                        <option>10</option>
                                        <option>12.5</option>
                                        <option>15</option>
                                        <option>20</option>
                                        <option>22.5</option>
                                        <option>25</option>
                                        <option>27.5</option>
                                        <option>30</option>
                                        <option>32.5</option>
                                        <option>35</option>     
                                        <option>37.5</option>
                                        <option>40</option>
                                        <option>42.5</option>
                                        <option>45</option>
                                        <option>47.5</option>
                                        <option>50</option>
                                        <option>52.5</option>
                                        <option>55</option>
                                        <option>57.5</option>
                                        <option>60</option>
                                        <option>62.5</option>
                                        <option>65</option>
                                        <option>67.5</option>
                                        <option>70</option>
                                        <option>75</option>
                                        <option>80</option>
                                        <option>85</option>
                                      
                                    </select>
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
    </div> --}}


    <div class='table-responsive'>
        <table class="table table-hover table-sm">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Hourly running cost</th>
                    <th scope="col">Gross margin percentage</th>
                    <th scope="col">Gross margin rate</th>
                    <th scope="col">Hourly charge rate</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($grossmargin as $gm)
                <tr>
                    <td>
                        {{ number_format($total_business_hourly_cost/365/8,2) }}
                    </td>
                    <td>
                        @switch($gm->gm_rate)
                            @case(1.111)
                                <span>10</span>
                                @break
                            @case(1.143)
                                <span>12.5</span>
                                @break
                            @case(1.176)
                                <span>15</span>
                                @break
                            @case(1.25)
                                <span>20</span>
                                @break
                            @case(1.29)
                                <span>22.5</span>
                                @break
                            @case(1.333)
                                <span>25</span>
                                @break
                            @case(1.379)
                                <span>27.5</span>
                                @break
                           @case(1.429)
                                <span>30</span>
                                @break
                            @case(1.481)
                                <span>32.5</span>
                                @break
                            @case(1.4925)
                                <span>33</span>
                                @break
                            @case(1.538)
                                <span>35</span>
                                @break
                            @case(1.6)
                                <span>37.5</span>
                                @break
                            @case(1.667)
                                <span>40</span>
                                @break
                            @case(1.739)
                                <span>42.5</span>
                                @break
                            @case(1.818)
                                <span>45</span>
                                @break
                            @case(1.905)
                                <span>47.5</span>
                                @break        
                            @case(2)
                                <span>50</span>
                                @break
                            @case(2.1092)
                                <span>52.5</span>
                                @break
                            @case(2.223)
                                <span>55</span>
                                @break
                            @case(2.3529)
                                <span>57.5</span>
                                @break
                            @case(2.5)
                                <span>60</span>
                                @break
                            @case(2.666)
                                <span>62.5</span>
                                @break
                            @case(2.852)
                                <span>65</span>
                                @break
                            @case(3.075)
                                <span>67.5</span>
                                @break
                            @case(3.333)
                                <span>70</span>
                                @break
                            @case(4)
                                <span>75</span>
                                @break
                            @case(5)
                                <span>80</span>
                                @break
                            @case(6.667)
                                <span>85</span>
                                @break
                            @default
                                <span>Something went wrong, please try again</span>
                        @endswitch
                    </td>
                    <td>
                       {{$gm->gm_rate}}
                    </td>
                    <td>
                        {{ number_format($total_business_hourly_cost/365/8 * $gm->gm_rate,2) }}
                    </td>
                    <td>
                        <a href="{{action('GrossMarginController@edit', $gm['pk_gm_id'])}}">Edit</a>
                    </td>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </div>
</div> 

@endif
@stop
