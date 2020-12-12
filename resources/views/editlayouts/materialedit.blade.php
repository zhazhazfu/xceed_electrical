@extends('layouts.app')

@section('title', 'Materials')

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
            <h3>Edit Material</h3>
            <form method="post" action="{{action('MaterialController@update', $pk_material_id)}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Supplier item code</label>
                        <input type="text" class="form-control" id="customerName" name="material_itemcode"
                            value="{{$materials->material_itemcode}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Material description</label>
                        <input type="text" class="form-control" id="inputCompany" name="material_description"
                            value="{{$materials->material_description}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Material Cost</label>
                        <label class="sr-only" for="inlineFormInputGroup">Material cost</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="text" class="form-control" id="materialCost" name="material_cost"
                                value="{{$materials->material_cost}}">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Supplier</label>
                        <select id="inputDiscount" name="fk_supplier_id" class="form-control">
                            @foreach($suppliers as $supplier)
                            @if ($supplier->pk_supplier_id == $materials->fk_supplier_id)
                            <option value="{{$supplier->pk_supplier_id}}" selected>{{$supplier->supplier_companyname}}
                            </option>
                            @else
                            <option value="{{$supplier->pk_supplier_id}}">{{$supplier->supplier_companyname}}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Archived</label>
                        <select id="material_archived" name="material_archived" class="form-control">
                            @if ($materials->material_archived == 0)
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
                    <a class="btn btn-secondary" href="{{url('/materials')}}">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
@stop
