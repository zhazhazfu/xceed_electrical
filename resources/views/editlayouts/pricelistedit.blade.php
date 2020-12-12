@extends('layouts.app')

@section('title', 'Price List')

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
            <h3>Edit Product</h3>
            <form method="post" action="{{url('/pricelists/'.$page_id.'/'.$pk_item_id.'/update')}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Item #</label>
                        <input type="text" class="form-control" id="item_number" name="item_number"
                            value="{{$priceLists->item_number}}">
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
                            @if($subCategory->pk_subcategory_id == $priceLists->fk_subcategory_id)
                            <option selected value="{{$subCategory->pk_subcategory_id}}">
                                {{$subCategory->subcategory_name}}</option>
                            @else
                            <option value="{{$subCategory->pk_subcategory_id}}">{{$subCategory->subcategory_name}}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Job description</label>
                        <input type="text" class="form-control" id="inputCompany" name="item_description"
                            value="{{$priceLists->item_description}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Select material</label>
                        <select class="form-control" id="fk_material_id" name="fk_material_id">
                            @foreach($materials as $material)
                            @if($material->pk_material_id == $priceLists->fk_material_id)
                            <option selected value="{{$material->pk_material_id}}">{{$material->material_description}}
                            </option>
                            @else
                            <option selected value="{{$material->pk_material_id}}">{{$material->material_description}}
                            </option>
                            @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Estimated time (h)</label>
                        <select id="item_estimatedtime" name="item_estimatedtime" class="form-control">
                            <option value="{{$priceLists->item_estimatedtime}}" selected>
                                {{$priceLists->item_estimatedtime}}
                            </option>
                            <option>0.00</option>
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
                            <input type="text" class="form-control" id="item_servicecall" name="item_servicecall"
                                value="{{$priceLists->item_servicecall}}">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Archived</label>
                        <select id="item_archived" name="item_archived" class="form-control">
                            @if ($priceLists->item_archived == 0)
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
                    <a class="btn btn-secondary" href="{{url('/pricelists/'.$page_id.'/')}}">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
@stop
