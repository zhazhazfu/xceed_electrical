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
                        <label class="sr-only" for="customer_name">Customer name</label>
                        <div class="input-group mb-2">
                            <select id="customer_name" name="customer_name" class="form-control">
                                @foreach($customers as $customer)
                                <option value="{{ $customer->pk_customer_id }}">
                                    {{ $customer->customer_name }}
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
                    <input type="text" class="form-control" id="quoteNumber" placeholder="######" readonly>
                </div>
                <div class="form-group col-md-6">
                    <label for="quoteDate">Date</label>
                    <input type="date" class="form-control" id="today" placeholder="10 September, 2020" readonly>
                </div>
            </div>
        </div>
        <div class="w-100"></div>
        <div class="col-sm-12">
            <div class="form row border-top">
                <div class="form-group col-sm">
                    <h5 class="pt-3 pb-1">Inclusions & Exclusions</h5>
                    <label for="quote_inclusions">Inclusions</label>
                    <textarea class="form-control" id="quote_inclusions" name="quote_inclusions" rows="2"></textarea>
                    <label for="quote_exclusions">Exclusions</label>
                    <textarea class="form-control" id="quote_inclusions" name="quote_exclusions" rows="2"></textarea>
                </div>
            </div>
        </div>
        <div class="w-100"></div>
        <div class="col-sm-12">
            <div class="form row border-top">
                <div class="form-group col-md-2">
                </div>
                <h5 class="pt-3 pb-1 ml-2 pl-1">Product</h5>
            </div>
            <div class="form-row">
                <div class="form-group col-md-1">
                </div>
                <div class="form-group col-md-1">
                    <label for="itemNo">#</label>
                    <input type="text" class="form-control" id="itemNo" placeholder="#" readonly>
                </div>
                <div class="form-group col-md">
                    <label for="selectCategory">Category</label>
                    <select class="form-control" id="selectCategory">
                        @foreach($categories as $category)
                        @if($category->category_archived == '0')
                        <option value="{{ $category->pk_category_id }}">{{ $category->category_name }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md">
                    <label for="selectCategory">Sub-Category</label>
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
                <div class="form-group col-md-2">
                </div>
                <div class="form-group col-md-2">
                    <label for="selectItemNumber">Item Code</label>
                    <select class="form-control" id="item_number" name="item_number">
                        @foreach($priceLists as $priceList)
                        @if($priceList->item_archived == '0')
                        <option value="{{ $priceList->pk_item_id }}">{{ $priceList->item_number }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md">
                    <label for="selectItemSescription">Description</label>
                    <select class="form-control" id="item_description" name="item_description">
                        @foreach($priceLists as $priceList)
                        @if($priceList->item_archived == '0')
                        <option value="{{ $priceList->pk_item_id }}">{{ $priceList->item_description }}</option>
                        @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row pb-2">
                <div class="form-group col-md-2">
                </div>
                <div class="form-group col-md-2">
                    <label for="input">Service Call</label>
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
                    <label for="input">Estimated Hours</label>
                    <label class="sr-only" for="customerName">Vehicle</label>
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" id="customerName" placeholder="Hours">
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
                    <label for="selectCategory">Gross Margin</label>
                    @foreach($grossmargins as $grossmargin)
                    <div class="input-group mb-2">
                        <input type="text" class="form-control" id="yearlypay" value="{{$grossmargin->gm_rate}}">
                        <div class="input-group-append">
                            <div class="input-group-text">%</div>
                        </div>
                        @endforeach
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
                            placeholder="Cost x GM" readonly>
                    </div>
                </div>
            </div>
            <div class="form row">
                <div class="form-group col-md-4">
                </div>
                <h5 class="pt-3 pb-1 pl-1 ml-1">Materials</h5>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                </div>
                <div class="form-group col-md">
                    <label for="selectCategory">Description</label>
                    <select class="form-control" id="selectCategory">
                        <option>Description</option>
                        <option>########</option>
                        <option>########</option>
                    </select>
                </div>
            </div>
            <div class="form-row pb-2">
                <div class="form-group col-md-4">
                </div>
                <div class="form-group col-md">
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
                    <label for="selectCategory">Gross Margin</label>
                    <select class="form-control" id="materialGM">
                        @foreach($grossmargins as $grossmargin)
                        <option value="{{$grossmargin->pk_gm_id}}">{{$grossmargin->gm_rate}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md">
                    <label for="input">Material Charge</label>
                    <label class="sr-only" for="inlineFormInputGroup">2</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly"
                            placeholder="Cost x GM" readonly>
                    </div>
                </div>
            </div>
            <div class="form row">
                <div class="form-group col-md-6">
                </div>
                <h6 class="pt-3 pb-1 pl-1">Total Labour & Materials Cost</h6>
            </div>
            <div class="form-row pb-2">
                <div class="form-group col-md-6">
                </div>
                <div class="form-group col-md">
                    <label for="input">Pre-margin</label>
                    <label class="sr-only" for="inlineFormInputGroup">2</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly"
                            placeholder="Total Cost" readonly>
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
                            placeholder="Total Charge" readonly>
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
                            placeholder="Total Profit" readonly>
                    </div>
                </div>
            </div>
            <div class="form row border-top">
                <div class="form-group col-md-8">
                </div>
                <h5 class="pt-3 pb-1 mt-2">Grand Total</h5>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                </div>
                <div class="form-group col-md">
                    <label for="selectCategory">Discount</label>
                    <select class="form-control" id="selectCategory" name="">
                        @foreach($discounts as $discount)
                        <option value="{{ $discount->pk_discount_id }}">
                            {{ $discount->discount_name }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                </div>
                <div class="form-group col-md">
                    <label for="input">GST</label>
                    <label class="sr-only" for="inlineFormInputGroup">2</label>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text">$</div>
                        </div>
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly"
                            placeholder="" readonly>
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
                            placeholder="" readonly>
                    </div>
                </div>
            </div>
            <div class="w-100"></div>
            <div class="col-sm-12">
                <div class="form row border-top">
                    <div class="form-group col-sm">
                        <h5 class="pt-3 pb-1">Terms & Conditions</h5>
                        <select class="form-control" id="term_name" name="term_name">
                            @foreach($quoteterms as $quoteterm)
                            <option value="{{ $quoteterm->pk_term_id }}">{{ $quoteterm->term_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="float-right">
                    <button type="button" class="btn btn-secondary">Cancel</button>
                    <button type="submit" class="btn btn-primary">Generate Quote</button>
                </div>
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
