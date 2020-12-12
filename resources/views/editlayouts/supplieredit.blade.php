@extends('layouts.app')

@section('title', 'Suppliers')

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
            <h3>Edit Supplier</h3>
            <form method="post" action="{{action('SupplierController@update', $pk_supplier_id)}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Supplier name</label>
                        <input type="text" class="form-control" id="supplier_companyname" name="supplier_companyname"
                            value="{{$suppliers->supplier_companyname}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Contact name</label>
                        <input type="text" class="form-control" id="supplier_contactname" name="supplier_contactname"
                            value="{{$suppliers->supplier_contactname}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Phone</label>
                        <input type="text" class="form-control" id="supplier_phone" name="supplier_phone"
                            value="{{$suppliers->supplier_phone}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Email</label>
                        <input type="text" class="form-control" id="supplier_email" name="supplier_email"
                            value="{{$suppliers->supplier_email}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Archived</label>
                        <select id="supplier_archived" name="supplier_archived" class="form-control">
                            @if ($suppliers->supplier_archived == 0)
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
                    <a class="btn btn-secondary" href="{{url('/suppliers')}}">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
@stop
