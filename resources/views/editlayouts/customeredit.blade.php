@extends('layouts.app')

@section('title', 'Customers')

@section('content')
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
            <h3>Edit Customer</h3>
            <form method="post" action="{{action('CustomerController@update', $pk_customer_id)}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Customer name</label>
                        <input type="text" class="form-control" id="customerName" name="customer_name"
                            value="{{$customers->customer_name}}">
                    </div>
                    <div class="form-group col-sm">
                        <label for="input">Company name</label>
                        <input type="text" class="form-control" id="inputCompany" name="customer_company"
                            value="{{$customers->customer_company}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Phone</label>
                        <input type="text" class="form-control" id="inputPhone" name="customer_phone"
                            value="{{$customers->customer_phone}}">
                    </div>
                    <div class="form-group col-sm">
                        <label for="input">Email</label>
                        <input type="email" class="form-control" id="inputEmail" name="customer_email"
                            value="{{$customers->customer_email}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Address</label>
                        <input type="text" class="form-control" id="inputAddress" name="customer_address"
                            value="{{$customers->customer_address}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Discount tier</label>
                        <select id="inputDiscount" name="customer_discount" class="form-control">
                            @foreach($discounts as $discount)
                            @if($discount->pk_discount_id == $customers->fk_discount_id)
                            <option value="{{$discount->pk_discount_id}}" selected>{{$discount->discount_name}}</option>
                            @else
                            <option value="{{$discount->pk_discount_id}}">{{$discount->discount_name}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Archived</label>
                        <select id="customer_archived" name="customer_archived" class="form-control">
                            @if ($customers->customer_archived == 0)
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
                    <a class="btn btn-secondary" href="{{url('/customers')}}">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
@stop
