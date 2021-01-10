@extends('layouts.app')

@section('title', 'quotesetting')

@section('content')

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

    <!-- Add material button -->
    <button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal" data-target="#materialModal">
        Add T&C
    </button>


                            <div class="form-group col-md-6">
                                <label for="input">T&C ID</label>
                                <label class="sr-only" for="inlineFormInputGroup">Terms and Conditions</label>
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
                    <h5 class="modal-title" id="materialModalLabel">Enter Terms & condition details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ url('quotesetting') }}">
                        {{ csrf_field() }}

                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Terms & condition </label>
                                <input type="text" class="form-control"
                                    name="term_body" placeholder="Enter description"/>

                            </div>
                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save T&C</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End modal -->

   
@stop
