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
        <form method="post" action="/quoting">
            <div class="col-sm-6 pb-2">
                {{ csrf_field() }}
                <h5 class="pt-3 pb-1">Customer Details</h5>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input">Customer name</label>
                        <label class="sr-only" for="customer_name">Customer name</label>
                        <div class="input-group mb-2">
                            <select id="customer_name" name="customer_name" class="form-control" required>
                                @foreach($customers as $customer)
                                <option value="{{ $customer->pk_customer_id }}">{{ $customer->customer_name }}</option>
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
                        <input type="text" class="form-control" name="quote_number" id="quoteNumber" placeholder="######" required="">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="quoteDate">Date</label>
                        <input type="date" class="form-control" id="today" placeholder="10 September, 2020" readonly>
                    </div>
                </div>
            </div>

        
            <div class="w-100 border-top"></div>
            <div id="select_job">
                <div id="select_job_html">
                    <div class="col-sm-12 pb-2">
                        <h5 class="pt-3 pb-1">Job</h5>
                        <div class="form-row">
                            <div class="form-group col-md-1">
                                <label for="itemNo">#</label>
                                <input type="text" class="form-control" id="itemNo" placeholder="#" readonly>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="selectCategory">Category</label>
                                <select class="form-control" id="selectCategory" onchange="getSubcategory(this)">
                                    <option value="" selected disabled>Please select a category</option>
                                    @foreach($categories as $category)
                                    @if($category->category_archived == '0')
                                    <option value="{{ $category->pk_category_id }}">{{ $category->category_name }}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="selectCategory">Sub-Category</label>
                                <select class="form-control" id="subcategorySelect" name="subcategorySelect" onchange="getItem(this)">
                                    <option value="" selected disabled>Please select a subcategory</option>
                                </select>
                            </div>
                            <div class="form-group col-md-3">
                                <label for="selectItemNumber">Item Code</label>
                                <select class="form-control" id="item_number" name="item_number" onchange="getDescription(this)">
                                    <option value="" selected disabled>Please select an item</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group w-100 px-2" id="description">
                                <input type="text" class="form-control" id="item_description" placeholder="Item Description" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <button id="dublicate_job" class="btn btn-primary">Add Jobs +</button>
                            </div>
                            <div class="form-group col-sm float-right">
                                <button id="remove_job" class="btn btn-primary float-right">Remove Jobs -</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 border-top"></div>
            <div class="col-sm-12 pb-2">
                <h5 class="pt-3 pb-1">Grand Total</h5>
                <div class="form-row">
                    <div class="form-group col-md-2">
                        <label for="input">GST</label>
                        <label class="sr-only" for="inlineFormInputGroup">2</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly" placeholder="" readonly>
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="input">Price Inc GST</label>
                        <label class="sr-only" for="inlineFormInputGroup">2</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly" placeholder="" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 border-top"></div>
            <div class="col-sm-12 pb-2">
                <h5 class="pt-3 pb-1">Inclusions & Exclusions</h5>
                <div class="form-row">
                    <div class="form-group">
                    </div>
                    <div class="form-group col-md-8">
                        <select class="form-control" id="term_name" name="ex_name" required>
                            @foreach($exclusions as $quoteterm)
                            <option value="{{ $quoteterm->pk_ex_id }}">{{ $quoteterm->exclusion_Content }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="quote_exclusions">Exclusions</label>
                        <select class="form-control" id="term_name" name="in_name" required>
                            @foreach($inclusions as $quoteterm)
                            <option value="{{ $quoteterm->pk_in_id }}">{{ $quoteterm->inclusion_Content }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            
            <div class="w-100 border-top"></div>
            <div class="col-sm-12 pb-2">
                <h5 class="pt-3 pb-1">Terms & Conditions</h5>
                <div class="form-row">
                    <div class="form-group">
                    </div>
                    <div class="form-group col-md-8">
                        <select class="form-control" id="term_name" name="term_name" required>
                            @foreach($quoteterms as $quoteterm)
                            <option value="{{ $quoteterm->pk_term_id }}">{{ $quoteterm->term_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        
            <div class="w-100 border-top"></div>
            <div class="col-sm-12">
                <div class="form row border-top">
                    <div class="form-group">
                    </div>
                    <h5> </h5>
                </div>
                <div class="form-row float-right">
                    <div class="form-group">
                    </div>
                        <button type="button" class="btn btn-secondary m-2">Cancel</button>
                        <button type="button" class="btn btn-secondary m-2">Save</button>
                        <button type="submit" class="btn btn-primary m-2">Generate Quote</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    let fk_subcategory_id = $("#my_select").change(function () {
        var id = $(this).children(":selected").attr("id");
    });

    function getSubcategory(element) {
        optionSelected = element.value;
        // alert(optionSelected);
        $('#subcategorySelect').find('option').not(':first').remove();

        $.ajax({
            url: "getSubcategories/" + optionSelected,
            context: document.body
        }).done(function(data) {

            // alert("data received");
            // alert(data.id);
            // alert(data.name);

        $('#item_number').find('option').not(':first').remove();
            
        $iteration = 0;

        data.id.forEach(function(subcategory) {
            option = document.createElement('option');
            option.value = data.id[$iteration];
            option.innerHTML = data.name[$iteration];

                // alert(option.value + option.innerHTML);
            document.getElementById('subcategorySelect').appendChild(option);
            $iteration++;
        });

        document.getElementById('item_description').value = "Item Description";

            // option = document.createElement('option');
            // option.value = data.id;
            // option.innerHTML = data.name;
            // document.getElementById('subcategorySelect').appendChild(option); 
        });
    }

    function getItem(element) {
        optionSelected = element.value;
        
        $('#item_number').find('option').not(':first').remove();

        $.ajax({
            url: "getItems/" + optionSelected,
            context: document.body
        }).done(function(data) {
            $iteration = 0;
            data.id.forEach(function(item) {
                option = document.createElement('option');
                option.value = data.id[$iteration];
                option.innerHTML = data.name[$iteration];

                document.getElementById('item_number').appendChild(option);
                $iteration++;
            });

            document.getElementById('item_description').value = "Item Description";
        });
    }

    function getDescription(element) {
        optionSelected = element.value;
        // alert(optionSelected);
        $.ajax({
            url: "getDescription/" + optionSelected,
            context: document.body

        }).done(function(data) {
            // alert(data.id);
            text = document.createTextNode(data.id);
            document.getElementById('item_description').value = data.id;
        });
    }
    // Sets todays date as the quote date
    let today = new Date().toISOString().substr(0, 10);
    document.querySelector("#today").value = today;
    document.querySelector("#today2").valueAsDate = new Date();
</script>
@stop
@push('js')
<script type="text/javascript">
    
    $(document).ready(function(){   
            $("#dublicate_job").click(function(e){
                e.preventDefault();
                $("#select_job").append($("#select_job_html").clone(true));
              });
              
            $("#remove_job").click(function(e){
                e.preventDefault();
                $("#select_job").children($("#select_job_html").remove());
              });
        });
</script>
@endpush