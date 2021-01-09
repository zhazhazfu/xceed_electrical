@extends('layouts.app')

@section('title', 'Quoting')

@section('content')

<div class="container rounded border pl-5 pr-5 pb-5">
    <h2 class="mt-3 mb-4">Create Quote</h2>
    <div class="row">
        <div class="col-sm-6 pb-4">
            <p>
                <h4>{{ $businessDetails->businessdetail_name }}</h4>
                {{ $businessDetails->businessdetail_addressline1 }}<br>
                {{ $businessDetails->businessdetail_addressline2 }}<br>
                {{ $businessDetails->businessdetail_phone }}<br>
                {{ $businessDetails->businessdetail_fax }}<br>
                {{ $businessDetails->businessdetail_email }}<br>
                {{ $businessDetails->businessdetail_website }}
            </p>
        </div>
        <div class="col-sm-6">
            <img src="images/Xceed_logo_small_01-copy1.png" class="img-fluid float-right" width="350px"
                alt="Responsive image">
        </div>
        <!-- Forces next column to break new line -->
        <div class="w-100 border-top"></div>
        <div class="col-sm-6 pb-2">
            <form>
                <h5 class="pt-3 pb-1">Customer Details</h5>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input">Customer name</label>
                        <label class="sr-only" for="customer_name">Customer Name</label>
                        <div class="input-group mb-2">
                            <input id="customer_name" name="customer_name" class="form-control">
                                @foreach($customers as $customer)
                                <option value="{{ $customer->pk_customer_id }}">
                                    {{ $customer->customer_name }}
                                </option>
                                @endforeach
                        </div>
                        <label for="input">Job Address</label>
                        <label class="sr-only" for="job_address">Job Address</label>
                        <div class="input-group mb-2">
                            <input id="job_address" name="job_address" class="form-control">
                        </div>
                        <label for="input">Customer Tier</label>
                        <label class="sr-only" for="customer_tier">Customer Tier</label>
                        <div class="input-group mb-2">
                            <select id="customer_tier" name="customer_tier" class="form-control">
                                @foreach($discounts as $discount)
                                <option value="{{ $discount->pk_discount_id }}">
                                    {{ $discount->discount_name }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
        </div>
        <div class="col-sm-6 pb-2">
            <h5 class="pt-3 pb-1">Quote Details</h5>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="quoteNumber">Quote Number</label>
                    <input type="text" class="form-control" id="quoteNumber">
                </div>
                <div class="form-group col-md-6">
                    <label for="quoteDate">Date</label>
                    <input type="date" class="form-control" id="today" placeholder="10 September, 2020">
                </div>
            </div>
        </div>
        <div class="w-100"></div>
        <div class="col-sm-12">
            <div class="form row border-top">
                <div class="form-group">
                </div>
                <h5 class="pt-3 pb-1 ml-2 pl-1">Item</h5>
            </div>
            <div class="form-row">
                <div class="form-group">
                </div>
                <div class="form-group">
                    <label for="itemName">Item Name</label>
                    <input type="text" class="form-control" id="itemName">
                </div>
                <div class="form-group col-md">
                    <label for="selectCategory">Job Category</label>
                    <input class="form-control" id="selectCategory">
                </div>
                <div class="form-group col-md">
                    <label for="selectCategory">Job Description</label>
                    <input class="form-control" id="fk_subcategory_id" name="fk_subcategory_id">
                </div>
            </div>
            <div class="form-row pb-2">
                <div class="form-group">
                </div>
                <div class="form-group">
                    <label for="input">Service Call</label>
                    <label class="sr-only" for="inlineFormInputGroup">2</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly" placeholder="">
                    </div>
                </div>
                <div class="form-group col-md">
                    <label for="input">Average Install Time</label>
                    <div class="input-group mb-2">
                        <select type="text" class="form-control" id="customerName"></select>
                    </div>
                </div>
                <div class="form-group col-md">
                    <label for="input">Labour Cost</label>
                    <label class="sr-only" for="inlineFormInputGroup">2</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly"
                            placeholder="">
                    </div>
                </div>
                <div class="form-group col-md">
                    <label for="input">Labour Charge</label>
                    <label class="sr-only" for="inlineFormInputGroup">2</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly"
                            placeholder="Cost x GM">
                    </div>
                </div>
                <div class="form-group col-md">
                    <label for="selectCategory">Gross Margin</label>
                    <select class="form-control" id="materialGM">
                        @foreach($grossmargins as $grossmargin)
                        <option value="{{$grossmargin->pk_gm_id}}">{{$grossmargin->gm_rate}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <hr>
            <div class="form row">
                <div class="form-group">
                </div>
                <h5 class="pt-3 pb-1 pl-1 ml-1">Materials</h5>
            </div>
            <div class="form-row">
                <div class="form-group">
                </div>
                <div class="form-group">
                    <label for="selectCategory">Material</label>
                    <div class="input-group-append">
                        <button class="btn btn-secondary" type="button" style="width:150px;">Add Material</button>
                    <select class="form-control" id="selectMaterial" style="margin-left:10px; width: 150px;">
                        {{-- @foreach($material as $materials)
                        <option value="{{ $materials -> pk_material_id }}">
                            {{ $materials -> material_description }}
                        </option>
                        @endforeach --}}
                    </select>
                </div>
                </div>
                
            </div>
            <div class="form-row pb-2">
                <div class="form-group">
                </div>
                <div class="form-group">
                    <label for="yearlypay">Quantity</label>
                    <input type="text" class="form-control" id="yearlypay" placeholder="#">
                </div>
                <div class="form-group col-md">
                    <label for="input">Material Cost</label>
                    <label class="sr-only" for="inlineFormInputGroup">2</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly"
                            placeholder="">
                    </div>
                </div>

                <div class="form-group col-md">
                    <label for="input">Material Charge</label>
                    <label class="sr-only" for="inlineFormInputGroup">2</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly"
                            placeholder="Cost x GM">
                    </div>
                </div>
            </div>
            <div class="form row">
                <div class="form-group">
                </div>
                <h6 class="pt-3 pb-1 pl-1">Total Labour & Materials Cost</h6>
            </div>
            <div class="form-row pb-2">
                <div class="form-group">
                </div>
                <div class="form-group col-md">
                    <label for="input">Pre-margin</label>
                    <label class="sr-only" for="inlineFormInputGroup">2</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly"
                            placeholder="Total Cost">
                    </div>
                </div>
                <div class="form-group col-md">
                    <label for="input">Post-Margin</label>
                    <label class="sr-only" for="inlineFormInputGroup">2</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly"
                            placeholder="Total Charge">
                    </div>
                </div>
                <div class="form-group col-md">
                    <label for="input">Profit</label>
                    <label class="sr-only" for="inlineFormInputGroup">2</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly"
                            placeholder="Total Profit">
                    </div>
                </div>
            </div>
            <hr>
                <div class="form row">
                    <div class="form-group col-sm">
                        <h5 class="pt-3 pb-1">Inclusions & Exclusions</h5>
                        <label for="quote_inclusions">Inclusions</label>
                        <textarea class="form-control" id="quote_inclusions" name="quote_inclusions" rows="2"></textarea>
                        <label for="quote_exclusions">Exclusions</label>
                        <textarea class="form-control" id="quote_inclusions" name="quote_exclusions" rows="2"></textarea>
                    </div>
                </div>
            <div class="form row border-top">
                <div class="form-group">
                </div>
                <h5 class="pt-3 pb-1" style="padding-left:10px;">Grand Total</h5>
            </div>
            <div class="form-row">
                <div class="form-group">
                </div>
                <div class="form-group col-md">
                    <label for="grandtotal">Total</label>
                    <div class="input-group mb-2" style="width:150px;">
                    <input class="form-control" id="grandtotal" name="">
                    </div>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                </div>
                <div class="form-group col-md">
                    <label for="input">GST</label>
                    <label class="sr-only" for="inlineFormInputGroup">2</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly"
                            placeholder="">
                    </div>
                </div>
                <div class="form-group col-md">
                    <label for="input">Price Inc GST</label>
                    <label class="sr-only" for="inlineFormInputGroup">2</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly"
                            placeholder="">
                    </div>
                </div>
            </div>
            <div class="w-100"></div>
                <div class="form row border-top">
                    <div class="form-group">
                        <h5 class="pt-3 pb-1">Terms & Conditions</h5>
                        <select class="form-control" id="term_name" name="term_name">
                            @foreach($quoteterms as $quoteterm)
                            <option value="{{ $quoteterm->pk_term_id }}">{{ $quoteterm->term_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input class="form-control" id="term_name" name="term_name" style="margin-bottom:20px;">
                </div>

                <div class="float-right" style="margin-top:20px;">
                    <button type="button" class="btn btn-secondary">Cancel</button>
                    <button type="button" class="btn btn-success">Save Draft</button>
                    <button type="submit" class="btn btn-primary">Generate Quote</button>
            </div>
        </div>
    </div>
    </form>
</div>

<script>
    let fk_subcategory_id = $("#my_select").change(function () {
        var id = $(this).children(":selected").attr("id");
    });

</script>

<!-- Sets todays date as the quote date -->
<script>
    let today = new Date().toISOString().substr(0, 10);
    document.querySelector("#today").value = today;

    document.querySelector("#today2").valueAsDate = new Date();

</script>
@stop
