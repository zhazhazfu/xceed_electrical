@extends('layouts.app')

@section('title', 'Quoting')

@section('content')

<!-- total company expenses -->
@php
$total = 0;
@endphp
@foreach($companyCosts as $companyCost)
@if($companyCost->companycost_archived == '0')
@php
$total += $companyCost->companycost_yearly;
@endphp
@endif
@endforeach


<!-- total employee costs -->
@php
$total_employee = 0;
$total_cost_less_super=0;
@endphp
@foreach($employeeCosts as $employeeCost)
@if($employeeCost->employee_archived == '0' && $employeeCost->employee_type == 'Employee')
@php
$total_employee += $employeeCost->employee_workercomp + $employeeCost->employee_hoursperweek*
$employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 +
$employeeCost->employee_phone +$employeeCost->employee_otherweeklycost +
$employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek*
$employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear;
$total_cost_less_super+=$employeeCost->employee_workercomp +
$employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
$employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone
+$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost +
$employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
$employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek*
$employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095;
@endphp
@endif
@endforeach


<!-- total sub-contractor costs -->
@php
$total_subcontractor = 0;
$total_cost_less_super=0;
@endphp
@foreach($employeeCosts as $employeeCost)
@if($employeeCost->employee_archived == '0' && $employeeCost->employee_type == 'Sub-Contractor')
@php
$total_subcontractor += $employeeCost->employee_cash + $employeeCost->employee_workercomp +
$employeeCost->employee_hoursperweek*
$employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095 +
$employeeCost->employee_phone +$employeeCost->employee_otherweeklycost +
$employeeCost->employee_vehiclecost + $employeeCost->employee_hoursperweek*
$employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear;
$total_cost_less_super+=$employeeCost->employee_workercomp +
$employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
$employeeCost->employee_weeksperyear*0.095 + $employeeCost->employee_phone
+$employeeCost->employee_otherweeklycost + $employeeCost->employee_vehiclecost +
$employeeCost->employee_hoursperweek* $employeeCost->employee_basehourly *
$employeeCost->employee_weeksperyear - $employeeCost->employee_hoursperweek*
$employeeCost->employee_basehourly * $employeeCost->employee_weeksperyear*0.095;
@endphp
@endif
@endforeach

<!-- total running cost -->
@php
$total_business_hourly_cost = $total + $total_employee + $total_subcontractor;
@endphp


<div class="container rounded border pl-5 pr-5 pb-5">
    <h2 class="mt-3 mb-4">Edit Draft</h2>
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
            <img src="/images/Xceed_logo_small_01-copy1.png" class="img-fluid float-right" width="350px"
                alt="Responsive image">
        </div>
        <!-- Forces next column to break new line -->
        <div class="w-100 border-top"></div>
        <form method="post" action={{url('save_draft')}}>
            {{ csrf_field() }}
            <input type="hidden" name="quote_id" value="{{$quote->pk_quote_id}}">
            <div class="col-sm-6 pb-2">
                <h5 class="pt-3 pb-1">Customer Details</h5>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="input">Customer name</label>
                        <label class="sr-only" for="customer_name">Customer name</label>
                        <div class="input-group mb-2">
                            <select id="customer_name" name="customer_name" class="form-control" required>
                                @foreach($customers as $customer)
                                <option @if($quote->customers->pk_customer_id == $customer->pk_customer_id) selected @endif value="{{ $customer->pk_customer_id }}">{{ $customer->customer_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 pb-2">
                <h5 class="pt-3 pb-1">Quote Details</h5>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="input">Quote Prefix</label>
                        <select class="form-control" id="quote_prefix" name="quote_prefix" required>
                            <label for="quote_prefix">Quote prefix</label>
                            <label class="sr-only" for="quote_prefix">Quote prefix</label>
                            @foreach($prefixes as $prefix)
                            <option @if($quote->prefix->pk_prefix_id == $prefix->pk_prefix_id) selected @endif value="{{ $prefix->pk_prefix_id }}">{{ $prefix->prefix_name}}</option>
                            @endforeach
                        </select>
                            {{-- @foreach (App\Quote::all() as $quotes )  --}}
                       
                            <label for="quoteNumber"></label>
                            <input type="hidden" class="form-control" name="quote_number" id="quote_number" value="{{$quote->quote_number}}" readonly>
                           
                      

                        {{-- <label for="quoteNumber"></label>
                        <input type="hidden" class="form-control" name="quote_number" id="quote_number" value="{{$quote->quote_number}}" readonly>   --}}
                    </div>
                    <div class="form-group col-md-4">
                        <label for="quoteDate">Date</label>
                        <input type="date" class="form-control" id="today" value="" readonly>
                    </div>
                    
                </div>
            </div>
        
            <div class="w-100 border-top"></div>
            <div id="select_job">
                <h5 class="pt-3 pb-1">Added Jobs</h5>
                @php
                    $final_price = 0;
                    $final_gst = 0;
                    $counter = 0;
                @endphp
                @foreach ($quote->quotehasitem as $key => $job )
                    
                    @php $counter ++; @endphp
                    <div data-id="{{$key+1}}" name="old_select_job_html" id="old_select_job_html">
                        <div class="col-sm-12 pb-2">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="selectCategory">Category</label>
                                    <select data-id="{{$key+1}}" class="form-control" id="selectCategory" onchange="getSubcategory(this)">
                                        <option value="" selected disabled>Please select a category</option>
                                        @foreach($categories as $category)
                                        @if($category->category_archived == '0')
                                        <option value="{{ $category->pk_category_id }}">{{ $category->category_name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-7">
                                    <label for="selectCategory">Sub-Category</label>
                                    <select data-id="{{$key+1}}" class="form-control" id="subcategorySelect" name="subcategorySelect" onchange="getItem(this)">
                                        <option value="" selected disabled>Please select a subcategory</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="selectItemNumber">Item Code</label>
                                    <select data-id="{{$key+1}}"  class="form-control" id="item_number" name="item_number[]" onchange="getDescription(this)">
                                        <option value="{{$job->items->pk_item_id}}" selected >{{$job->items->item_number}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-8" id="description">
                                    <input data-id="{{$key+1}}" type="text" class="form-control" name="item_description" id="item_description" placeholder="Item Description" value="{{$job->items->item_description}}" readonly>
                                </div>
                                <?php 
                                   $temp_mat_cost = 0;
                                    foreach ($job->items->itemHasMaterials as $temp_itemHasMaterial)
                                    {
                                        $temp_mat_cost += $temp_itemHasMaterial->material->material_cost*$temp_itemHasMaterial->quantity;
                                    }
                                    $final_price += number_format(($temp_mat_cost*$grossMargin->gm_rate) + $job->items->item_servicecall + $job->items->item_estimatedtime * $total_business_hourly_cost * ($grossMargin->gm_rate /365/8),2);  

                                    $tmp_gst_price = number_format((($temp_mat_cost*$grossMargin->gm_rate) + $job->items->item_servicecall + $job->items->item_estimatedtime * $total_business_hourly_cost * ($grossMargin->gm_rate /365/8))*1.1,2);
                                    $final_gst += $tmp_gst_price;  


                                ?>
                                <div class="form-group col-md-4" id="description">
                                    <input data-id="{{$key+1}}" type="text" class="form-control" name="item_price" id="item_price" value="{{$tmp_gst_price}}" placeholder="$0.00" readonly>
                                </div>
                            </div>
                           <!--  <div class="form-row">
                                <div class="form-group col-sm">
                                    <button data-id="{{$key+1}}" id="dublicate_job" class="btn btn-primary">Add Job</button>
                                </div>
                                <div class="form-group col-sm float-right">
                                    <button data-id="{{$key+1}}" id="remove_job" class="btn btn-danger float-right">Remove Job</button>
                                </div>
                            </div> -->
                        </div>
                    </div>
                @endforeach

            </div>
                <input type="hidden" name="counter" value="{{$counter}}">
                <div class="w-100 border-top"></div>
                    <div id="select_job">
                        <h5 class="pt-3 pb-1">New Job</h5>
                    <div data-id="{{$counter}}" name="select_job_html" id="select_job_html">
                            <div class="col-sm-12 pb-2">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="selectCategory">Category</label>
                                        <select data-id="{{$counter}}" class="form-control" id="selectCategory" onchange="getSubcategory(this)">
                                            <option value="" selected disabled>Please select a category</option>
                                            @foreach($categories as $category)
                                            @if($category->category_archived == '0')
                                            <option value="{{ $category->pk_category_id }}">{{ $category->category_name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-7">
                                        <label for="selectCategory">Sub-Category</label>
                                        <select data-id="{{$counter}}" class="form-control" id="subcategorySelect" name="subcategorySelect" onchange="getItem(this)">
                                            <option value="" selected disabled>Please select a subcategory</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="selectItemNumber">Item Code</label>
                                        <select data-id="{{$counter}}" class="form-control" id="item_number" name="item_number[]" onchange="getDescription(this)">
                                            <option value="" selected disabled>Please select an item</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8" id="description">
                                        <input data-id="{{$counter}}" type="text" class="form-control" name="item_description" id="item_description" placeholder="Item Description" readonly>
                                    </div>
                                    <div class="form-group col-md-4" id="description">
                                        <input data-id="{{$counter}}" type="text" class="form-control" name="item_price" id="item_price" placeholder="" readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-sm">
                                        <button data-id="{{$counter}}" id="dublicate_job" class="btn btn-primary">Add Job</button>
                                    </div>
                                    <div class="form-group col-sm float-right">
                                        <button data-id="{{$counter}}" id="remove_job" class="btn btn-danger float-right">Remove Job</button>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>

            <div class="w-100 border-top"></div>
            <div class="col-sm-12 pb-2">
                <h5 class="pt-3 pb-1">Grand Total</h5>
                <div class="form-row">
                    <div class="form-group">
                    </div>
                    <div class="form-group col-md-2">
                        <label for="input">Price</label>
                        <label class="sr-only" for="inlineFormInputGroup">2</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="text" class="form-control price_input" id="inlineFormInputGroup" value="{{$final_price}}" name="price"
                                placeholder="" readonly>
                        </div>
                    </div>
                    <div class="form-group col-md-2">
                        <label for="input">Price Inc GST</label>
                        <label class="sr-only" for="inlineFormInputGroup">2</label>
                        <div class="input-group mb-2">
                            <div class="input-group-prepend">
                                <div class="input-group-text">$</div>
                            </div>
                            <input type="text" class="form-control gst_input" id="inlineFormInputGroup" value="{{$final_gst}}" name="gst_price"
                                placeholder="" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 border-top"></div>
            <div class="col-sm-12 pb-2">
                <h5 class="pt-3 pb-1">Inclusions & Exclusions</h5>
                <div id="select_inc">
                    <div id="select_inc_html">
                        <div class="form-row">
                            <div class="form-group">
                                <div class="form-group w-100">
                                    <label for="quote_inclusions">Inclusions</label>
                                    <br>
                                    <select style="display: inline" class="form-control col-md-11 my-2" id="inc_selector" name="inc_selector" >
                                        @foreach($inclusions as $quoteinc)
                                        <option value="{{ $quoteinc->pk_in_id }}">{{ $quoteinc->inclusion_Content }}</option>
                                        @endforeach
                                    </select>

                                    <button style="display: inline" id="duplicate_inc" class="btn btn-primary float-right my-2">Add</button>

                                    <textarea class="form-control" id="inc_name" name="inc_name" rows="5"  >{{$quote->inclusions}}</textarea>
                                    
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-100 border-top"></div>
            <div class="col-sm-12 pb-2">
                <div id="select_exc">
                    <div id="select_exc_html">
                        <div class="form-row">
                            <div class="form-group w-100">
                                <label for="quote_exclusions">Exclusions</label>

                                <br>
                                <select style="display: inline" class="form-control col-md-11 my-2" id="exc_selector" name="exc_selector" >
                                    @foreach($inclusions as $quoteinc)
                                    <option value="{{ $quoteinc->pk_in_id }}">{{ $quoteinc->inclusion_Content }}</option>
                                    @endforeach
                                </select>

                                <button style="display: inline" id="duplicate_exc" class="btn btn-primary float-right my-2">Add</button>

                                <textarea class="form-control" id="exc_name" name="exc_name" rows="5" >{{$quote->exclusions}}</textarea>

                                <!-- <select class="form-control" id="exc_name" name="exc_name" required>
                                    @foreach($exclusions as $quoteexc)
                                    <option value="{{ $quoteexc->pk_ex_id }}">{{ $quoteexc->exclusion_Content }}</option>
                                    @endforeach
                                </select>    
                                <button id="duplicate_exc" class="btn btn-primary my-2">Add</button>
                                <button id="remove_exc" class="btn btn-danger">Remove</button> -->
                            </div>
                        </div>
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
                        <select class="form-control" id="term_name" name="term_name" >
                            @foreach($quoteterms as $quoteterm)
                            <option @if($quote->quoteterms->pk_term_id == $quoteterm->pk_term_id) selected @endif value="{{ $quoteterm->pk_term_id }}">{{ $quoteterm->term_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>

            <div class="w-100 border-top"></div>
            <div class="col-sm-12 pb-2">
                <h5 class="pt-3 pb-1">Quote Comment</h5>
                <div class="form-row">
                    <div class="form-group">
                    </div>
                    <div class="form-group col-md-8">
                        <input text="text" class="form-control" id="quote_comment" name="quote_comment" value="{{$quote->quote_comment}}" >
                    </div>
                </div>
            </div>
        
            <div class="w-100 border-top"></div>
            <div class="col-sm-12">
                <div class="form-row float-right">
                    <button type="button" class="btn btn-secondary m-2">Cancel</button>
                    <button type="submit" name="save" value="3" class="btn btn-secondary m-2">Save</button>
                    <button type="submit" name="generate" value="1" class="btn btn-primary m-2">Generate Quote</button>
                </div>
            </div>
        </form>
    </div>
</div>



@push('js')
<script type="text/javascript">
    
    let fk_subcategory_id = $("#my_select").change(function () {
        var id = $(this).children(":selected").attr("id");
    });

    var count = {{$counter}}; //counter for data-id
    
    function calculateTotal() {
        var id_values = $("select[name='item_number[]']").map(function(){return $(this).val();}).get();
        console.log(id_values);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            } 
        });

        $.ajax({
            type:'POST',
            
            url:'{{ URL::to('/quote_pricings') }}',
                        
            data:{ id_values: id_values},
                        
            success:function(data){
                $(".price_input").val(data.final_price);
                $(".gst_input").val(data.final_gst);
            },
        });

        // alert("total calculated");
    }
    
    function getSubcategory(element) {  //to get subcategory according to user's selection
        optionSelected = element.value;
        number = element.getAttribute("data-id");
        // number = number - 1;
        
        $.ajax({
            url: "/getSubcategories/" + optionSelected,
            context: document.body
        }).done(function(data) {
            // alert(data);
            // alert("data received");
            $iteration = 0;

            // alert ("aaaa");
            section = document.getElementsByName('subcategorySelect');
            // console.log(section);
            
            var i;
            var x;
            // for loop to determine which one gets begone-d
            for (i=0; i<section.length; i++) {
                sectionID = section[i].getAttribute('data-id');
                // alert(sectionID);
                if (sectionID == number) {
                    // alert('match found: ' + sectionID);
                    x = i;
                }
            }


            selectOption = document.getElementsByName('subcategorySelect')[x];
            selectItems = document.getElementsByName('item_number[]')[x];

            // $('#item_number[]').find('option').not(':first').remove();
            // $('#subcategorySelect').find('option').not(':first').remove();
            
            // code to remove the previous selections
            while (selectOption.firstChild) {
                selectOption.removeChild(selectOption.firstChild);
            }

            while (selectItems.firstChild) {
                selectItems.removeChild(selectItems.firstChild);
            }

            option = document.createElement('option');
                option.value = "";
                option.innerHTML = "Please select a subcategory";
                selectOption.appendChild(option);

            option2 = document.createElement('option');
                option2.value = "";
                option2.innerHTML = "Please select an item";
                selectItems.appendChild(option2);

            //for each thing in the data make an option
            data.id.forEach(function(subcategory) {
                option = document.createElement('option');
                option.value = data.id[$iteration];
                option.innerHTML = data.name[$iteration];
                selectOption.appendChild(option);
                $iteration++;
            });
            // clear previous item description
            calculateTotal();
            document.getElementsByName('item_description')[x].value = "Item Description";
            document.getElementsByName('item_price')[x].value= "0.00";
        });
    }

    function getItem(element) {  //to get item number according to subcategory
        optionSelected = element.value;
        number = element.getAttribute("data-id");
        // number = number - 1;
        // alert(number);
        // $('#item_number[]').find('option').not(':first').remove();

        $.ajax({
            url: "/getItems/" + optionSelected,
            context: document.body
        }).done(function(data) {
            $iteration = 0;

            // section = document.getElementsByName('item_number[]');
            //     console.log(section);
            
            var i;
            var x;
            // for loop to determine which one gets begone-d
            for (i=0; i<section.length; i++) {
                sectionID = section[i].getAttribute('data-id');
                // alert(sectionID);
                if (sectionID == number) {
                    // alert('match found: ' + sectionID);
                    x = i;
                }
            }

            selectItems = document.getElementsByName('item_number[]')[x];

            var countCheck = 0;
            while (selectItems.firstChild) {
                selectItems.removeChild(selectItems.firstChild);
            }

            option = document.createElement('option');
                option.value = "";
                option.innerHTML = "Please select an item";
                option.disabled = true;
                option.selected = true;
                selectItems.appendChild(option);
            
            data.id.forEach(function(item) {
                option = document.createElement('option');
                option.value = data.id[$iteration];
                option.innerHTML = data.name[$iteration];

                selectItems.appendChild(option);
                $iteration++;
            });

            // var id_values = $("select[name='item_number[]']").map(function(){return $(this).val();}).get();
            // console.log(id_values);

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     } 
            // });

            // $.ajax({
            //     type:'POST',
                
            //     url:'{{ URL::to('/quote_pricings') }}',
                            
            //     data:{ id_values: id_values},
                            
            //     success:function(data){
            //         $(".price_input").val(data.final_price);
            //         $(".gst_input").val(data.final_gst);
            //     },
            // });
            
            document.getElementsByName('item_description')[x].value = "Item Description";
            document.getElementsByName('item_price')[x].value= "0.00";
           // calculateTotal();
        });
    }

    function getDescription(element) { //to get description according to item number
        optionSelected = element.value;
        number = element.getAttribute("data-id");
        // number = number - 1;

        // alert(optionSelected);

        // var id_values = $("select[name='item_number[]']").map(function(){return $(this).val();}).get();
        // console.log(id_values);

        // $.ajaxSetup({
        //     headers: {
        //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     } 
        // });

        // $.ajax({
        //     type:'POST',
            
        //     url:'{{ URL::to('/quote_pricings') }}',
                        
        //     data:{ id_values: id_values},
                        
        //     success:function(data){
        //         $(".price_input").val(data.final_price);
        //         $(".gst_input").val(data.final_gst);
        //     },
        // });

        $.ajax({
            url: "/getDescription/" + optionSelected,
            context: document.body

        }).done(function(data) {
            // alert(data.id);

            section = document.getElementsByName('item_description');
                // console.log(section);
            
            var i;
            var x;
            // for loop to determine which one gets begone-d
            for (i=0; i<section.length; i++) {
                sectionID = section[i].getAttribute('data-id');
                // alert(sectionID);
                if (sectionID == number) {
                    // alert('match found: ' + sectionID);
                    x = i;
                }
            }

            // alert("step 1");
            // var price = calculatePrice(optionSelected);
            // alert("step 3");
            // console.log(price);
            // alert(price);

            document.getElementsByName('item_description')[x].value = data.id;
            document.getElementsByName('item_price')[x].value= "0.00";
            calculatePrice(optionSelected, x);
            calculateTotal();
        });
    }

    function calculatePrice(id,counter) {
        // alert("calculating price...");
        $.ajax({
            url: "/calculatePrice/" + id,
            context: document.body
        }).done(function(data) {
            console.log("price = " + data.price);
            // alert("price = " + data.price);
            section = document.getElementsByName('item_price');
            
            // alert(data.price);
            section[counter].value = data.price;
            // return(data);
        });
    };

    $(document).ready(function(){ 
     var check = 0;  //add and remove the jobs
        $("#dublicate_job").click(function(e){
            e.preventDefault();
            // iterate the counter
            
                count++;
                //alert("new count = " + count);

                // get the section
                var copy = $("#select_job_html").clone(true);

                //reach the children of the section (it's a bit nested)
                var c = copy.children().children().children().children();

                // this code showed the tags of each child, e.g. "DIV, SELECT, DIV..."
                // var txt = "";
                // var i;
                // for (i = 0; i < d.length; i++) {
                //     txt = txt + d[i].tagName + ", ";
                // }

                // sets the data-id attribute for each selectable element (form controls and such)
                copy[0].setAttribute('data-id', count);
                c[1].setAttribute('data-id', count);
                c[3].setAttribute('data-id', count);
                c[5].setAttribute('data-id', count);
                c[6].setAttribute('data-id', count);
                c[7].setAttribute('data-id', count);
                c[8].setAttribute('data-id', count);
                c[9].setAttribute('data-id', count);
                
                $("#select_job").append(copy);
                calculateTotal();
            
        });
    
        // remove a job from the menu
        $("#remove_job").click(function(e){
            e.preventDefault();
            // get data-id from the selector 
            number = this.getAttribute("data-id");

            // find the section to delete
            section = document.getElementsByName('select_job_html');
            // console.log(section);
            var i;
            var x;
            // for loop to determine which one gets begone-d
            for (i=0; i<section.length; i++) {
                sectionID = section[i].getAttribute('data-id');
                // alert(sectionID);
                if (sectionID == number) {
                    // alert('match found: ' + sectionID);
                    x = i;
                }
            }

            finalSection = section[x];

            // var id_values = $("select[name='item_number[]']").map(function(){return $(this).val();}).get();
            // console.log(id_values);

            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     } 
            // });

            // $.ajax({
            //     type:'POST',
                
            //     url:'{{ URL::to('/quote_pricings') }}',
                            
            //     data:{ id_values: id_values},
                            
            //     success:function(data){
            //         $(".price_input").val(data.final_price);
            //         $(".gst_input").val(data.final_gst);
            //     },
            // });
                // alert("aaa");
            

            // alert(finalSection.getAttribute('data-id'));
            // $("#select_job").children($("#select_job_html")[number].remove());

            finalSection.remove();
            calculateTotal();
        });
    });

    $(document).ready(function(){  //add and remove the inclusions
        $("#duplicate_inc").click(function(e){
            e.preventDefault();
            incSel = document.getElementById("inc_selector");
            incText = incSel[incSel.selectedIndex].text + "; ";
            // alert(incText);
            box = document.getElementById("inc_name");
            // box.innerHTML = (newTxt);
            $("#inc_name").val(box.value + incText);
        });
    });
    
    $(document).ready(function(){   //add and remove the exclusions
        $("#duplicate_exc").click(function(e){
            e.preventDefault();
            excSel = document.getElementById("exc_selector");
            excText = excSel[excSel.selectedIndex].text + "; ";
            // alert(excText);
            box = document.getElementById("exc_name");
            // box.innerHTML = (newTxt);
            $("#exc_name").val(box.value + excText);
        });
    });
</script>
@endpush

<!-- Sets todays date as the quote date -->
<script>
    let today = new Date().toISOString().substr(0, 10);
    document.querySelector("#today").value = today;
    document.querySelector("#today2").valueAsDate = new Date();
</script>
@stop