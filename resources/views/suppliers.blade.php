@extends('layouts.app')

@section('title', 'Suppliers')

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

    <!-- Add supplier button -->
    <button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal" data-target="#supplierModal">
        Add Supplier
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
    <div class="modal fade" id="supplierModal" tabindex="-1" role="dialog" aria-labelledby="supplierModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="supplierModalLabel">Enter supplier details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="{{ url('suppliers') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="supplier_archived" value="0">
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Supplier name</label>
                                <input type="text" class="form-control" id="companyName" name="supplier_companyname"
                                    placeholder="Enter company">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Contact name</label>
                                <input type="text" class="form-control" id="contactName" name="supplier_contactname"
                                    placeholder="Enter contact name">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Phone</label>
                                <input type="text" class="form-control" id="supplierPhone" name="supplier_phone"
                                    placeholder="Enter phone">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Email</label>
                                <input type="text" class="form-control" id="supplierEmail" name="supplier_email"
                                    placeholder="Enter email">
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Supplier</button>
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
                <p class="h2">Suppliers</p>
            </div>

            <div class="col-sm-5">

                <input type="text" class="form-control float-right" id="active_input" onkeyup="activeFunction()"
                    placeholder="Search supplier name">

            </div>
        </div>
        <div class='table-responsive'>
            <table id="active_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortActive(0)">Company Name</th>
                        <th scope="col" onclick="sortActive(1)">Contact Name</th>
                        <th scope="col" onclick="sortActive(2)">Phone</th>
                        <th scope="col" onclick="sortActive(3)">Email</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                    @if($supplier->supplier_archived == 0)
                    <tr>
                        <td>{{ $supplier->supplier_companyname }}</td>
                        <td>{{ $supplier->supplier_contactname }}</td>
                        <td>{{ $supplier->supplier_phone }}</td>
                        <td>{{ $supplier->supplier_email }}</td>
                        <td><a href="{{action('SupplierController@edit', $supplier['pk_supplier_id'])}}">Edit</a></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Archived content -->
    <div id="archived_div" style="display: none">

        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Archived Suppliers</p>
            </div>

            <div class="col-sm-5">
                    <input type="text" class="form-control float-right" id="archived_input" onkeyup="archivedFunction()"
                        placeholder="Search supplier name">
            </div>
        </div>
        <div class='table-responsive'>
            <table id="archived_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortArchived(0)">Company Name</th>
                        <th scope="col" onclick="sortArchived(1)">Contact Name</th>
                        <th scope="col" onclick="sortArchived(2)">Phone</th>
                        <th scope="col" onclick="sortArchived(3)">Email</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($suppliers as $supplier)
                    @if($supplier->supplier_archived == 1)
                    <tr>
                        <td>{{ $supplier->supplier_companyname }}</td>
                        <td>{{ $supplier->supplier_contactname }}</td>
                        <td>{{ $supplier->supplier_phone }}</td>
                        <td>{{ $supplier->supplier_email }}</td>
                        <td><a href="{{action('SupplierController@edit', $supplier['pk_supplier_id'])}}">Edit</a></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

</div>

@stop
