@extends('layouts.app')

@section('title', 'Add Items')

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
                    <form method="post" action="{{ url('addItem') }}">
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
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Labour Cost</label>
                                <label class="sr-only" for="inlineFormInputGroup">Labour Cost</label>
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">$</div>
                                    </div>
                                    <input type="text" class="form-control" id="item_labourcost"
                                        name="item_labourcost" placeholder="10">
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
@stop
