@extends('layouts.app')

@section('title', 'Customers')

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

    <!-- Add customer button -->
    <button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal" data-target="#customerModal">
        Add Customer
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
    <div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="customerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="customerModalLabel">Enter customer details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="{{ url('customers') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="customer_archived" value="0">
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Customer name</label>
                                <input type="text" class="form-control" id="inputName" name="customer_name"
                                    placeholder="Enter customer name">
                            </div>
                            <div class="form-group col-sm">
                                <label for="input">Company name</label>
                                <input type="text" class="form-control" id="inputCompany" name="customer_company"
                                    placeholder="Enter company">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Phone</label>
                                <input type="text" class="form-control" id="inputPhone" name="customer_phone"
                                    placeholder="Enter phone">
                            </div>
                            <div class="form-group col-sm">
                                <label for="input">Email</label>
                                <input type="email" class="form-control" id="inputEmail" name="customer_email"
                                    placeholder="Enter email">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Address</label>
                                <input type="text" class="form-control" id="inputAddress" name="customer_address"
                                    placeholder="Enter address">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Discount tier</label>
                                <select id="inputDiscount" name="customer_discount" class="form-control">
                                    @foreach($discounts as $discount)
                                    <option value="{{ $discount->pk_discount_id }}">
                                        {{ $discount->discount_name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Customer</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End modal -->

    <div id="active_div">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Customers</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="active_input" onkeyup="activeFunction()"
                    placeholder="Search customer name">
            </div>
        </div>
        <div class='table-responsive'>
            <table id="active_table" class="display table table-hover table-sm mt-1">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortActive(0)">Name</th>
                        <th scope="col" onclick="sortActive(1)">Company</th>
                        <th scope="col" onclick="sortActive(2)">Phone</th>
                        <th scope="col" onclick="sortActive(3)">Email</th>
                        <th scope="col" onclick="sortActive(4)">Address</th>
                        <th scope="col" onclick="sortActive(5)">Discount</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    @if($customer->customer_archived == '0')
                    <tr>
                        <td>{{ $customer->customer_name }}</td>
                        <td>{{ $customer->customer_company }}</td>
                        <td>{{ $customer->customer_phone }}</td>
                        <td>{{ $customer->customer_email }}</td>
                        <td>{{ $customer->customer_address }}</td>
                        <td>{{ $customer->discount->discount_name }}</td>
                        <td><a href="{{action('CustomerController@edit', $customer['pk_customer_id'])}}">Edit</a></td>
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
                <p class="h2">Archived customers</p>
            </div>

            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="archived_input" onkeyup="archivedFunction()"
                    placeholder="Search customer name">
            </div>
        </div>

        <div class='table-responsive'>
            <table id="archived_table" class="display table table-hover table-sm mt-1">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortArchived(0)">Name</th>
                        <th scope="col" onclick="sortArchived(1)">Company</th>
                        <th scope="col" onclick="sortArchived(2)">Phone</th>
                        <th scope="col" onclick="sortArchived(3)">Email</th>
                        <th scope="col" onclick="sortArchived(4)">Address</th>
                        <th scope="col" onclick="sortArchived(5)">Discount</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($customers as $customer)
                    @if ($customer->customer_archived == '1')
                    <tr>
                        <td>{{ $customer->customer_name }}</td>
                        <td>{{ $customer->customer_company }}</td>
                        <td>{{ $customer->customer_phone }}</td>
                        <td>{{ $customer->customer_email }}</td>
                        <td>{{ $customer->customer_address }}</td>
                        <td>{{ $customer->discount->discount_name }}</td>
                        <td><a href="{{action('CustomerController@edit', $customer['pk_customer_id'])}}">Edit</a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

@stop
