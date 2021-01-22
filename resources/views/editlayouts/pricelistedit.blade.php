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
            <form method="post" action="{{url('/pricelists/'.$page_id.'/'.$pk_item_has_materails_id.'/update')}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Item #</label>
                   
                            <input type="text" class="form-control" id="item_number" name="item_number"
                            value="{{$item->item_number}}">
                        
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
                            @if($subCategory->pk_subcategory_id == $item->fk_subcategory_id)
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
                            value="{{$item->item_description}}">
                    </div>
                </div>
                <div id="select_mat">
                @foreach ( $itemHasMaterial as $itemHasMaterials)
                        
                @if ($itemHasMaterials->fk_item_id == $item->pk_item_id)
                  
                                    <div id="select_mat_html">
                                            <div class="form-row" >
                                                <div class="form-group col-sm">
                                                    <label for="input">Select material</label>
                                                    <select class="form-control" id="fk_material_id" name="fk_material_id[]">
                                                        @foreach($materials as $material)
                                                            @if($material->pk_material_id == $itemHasMaterials->fk_material_id)
                                                            <option selected value="{{$material->pk_material_id}}">{{$material->material_description}}
                                                            </option>
                                                            @else
                                                            <option  value="{{$material->pk_material_id}}">{{$material->material_description}}
                                                            </option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row" >
                                                <div class="form-group col-sm">
                                                <label for="input">Material quantity</label>
                                                <input type="number" value="{{$itemHasMaterials->quantity}}" class="form-control" id="item_description" name="quantity[]"
                                                    placeholder="0" required>
                                                </div>
                                            </div>

                                            <div class="form-group col-sm">
                                                    <label for="input">Archived</label>
                                                    <select class="form-control" id="archived" name="archived[]">
                                                        
                                                            
                                                            <option @if($itemHasMaterials->archived == 0) 
                                                                selected  @endif value="0">NO
                                                            </option>
                                                           
                                                            <option @if($itemHasMaterials->archived == 1) 
                                                                selected  @endif value="1">Yes
                                                            </option>
                                                            
                                                        
                                                    </select>
                                                </div>
                                    </div>
                                    
                    
                @endif
                        
                @endforeach

                                <div class="new_mat " style="display: none;" id="new_select_mat_html">
                                        <div class="form-row" >
                                            <div class="form-group col-sm">
                                                <label for="input">Select material</label>
                                                <select class="form-control" id="fk_material_id" name="new_fk_material_id[]">
                                                    <option value="select material" selected disabled></option>
                                                    @foreach($materials as $material)
                                                    <option value="{{ $material -> pk_material_id }}">
                                                        {{ $material -> material_description}}
                                                    </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="new_qty" class="form-row" >
                                            <div class="form-group col-sm">
                                            <label for="input">Material quantity</label>
                                            <input type="number" class="form-control" id="item_description" name="new_quantity[]"
                                                placeholder="0" >
                                            </div>
                                        </div>
                                    </div>

                </div>

                <div class="form-row">
                            <div class="form-group col-sm">
                                <button id="dublicate_mat" class="btn btn-primary">Add more +</button>
                            </div>
                        </div>
               
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Estimated time (h)</label>
                        <select id="item_estimatedtime" name="item_estimatedtime" class="form-control">
                            <option value="{{$item->item_estimatedtime}}" selected>
                                {{$item->item_estimatedtime}}
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
                                value="{{$item->item_servicecall}}">
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Archived</label>
                        <select id="item_archived" name="item_archived" class="form-control">
                            @if ($item->item_archived == 0)
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
                    <input type="submit" class="btn btn-primary" value="Save" >
                </div>
            </form>
        </div>
    </div>
</div>
@stop

@push('js')
<script type="text/javascript">
    

    $(document).ready(function(){

        var check = 0;
            $("#dublicate_mat").click(function(e){
                e.preventDefault();
console.log(check);
                if(check<1)
                {
                    document.getElementById("new_select_mat_html").style.display = "block";
                     check++;
                }
                else
                {

                    $("#select_mat").append($("#new_select_mat_html").clone(true));
                }
              });

        });
</script>
@endpush