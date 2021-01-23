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
                    <input type="text" class="form-control" name="quote_number" id="quoteNumber" placeholder="######">
                </div>
                <div class="form-group col-md-6">
                    <label for="quoteDate">Date</label>
                    <input type="date" class="form-control" id="today" placeholder="10 September, 2020" readonly>
                </div>
            </div>
        </div>

    
        <div class="w-100 border-top"></div>
        <div id="select_job">
            <h5 class="pt-3 pb-1">Job</h5>
            <div data-id="1" name="select_job_html" id="select_job_html">
                <div class="col-sm-12 pb-2">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="selectCategory">Category</label>
                            <select data-id="1" class="form-control" id="selectCategory" onchange="getSubcategory(this)">
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
                            <select data-id="1" class="form-control" id="subcategorySelect" name="subcategorySelect" onchange="getItem(this)">
                                <option value="" selected disabled>Please select a subcategory</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="selectItemNumber">Item Code</label>
                            <select data-id="1" class="form-control" id="item_number" name="item_number" onchange="getDescription(this)">
                                <option value="" selected disabled>Please select an item</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group w-100 px-2" id="description">
                            <input data-id="1" type="text" class="form-control" name="item_description" id="item_description" placeholder="Item Description" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-sm">
                            <button data-id="1" id="dublicate_job" class="btn btn-primary">Add Job</button>
                        </div>
                        <div class="form-group col-sm float-right">
                            <button data-id="1" id="remove_job" class="btn btn-danger float-right">Remove Job</button>
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
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly"
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
                        <input type="text" class="form-control" id="inlineFormInputGroup" name="employee_basehourly"
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
                                <div class="form-group col-md-8">
                                    <label for="quote_inclusions">Inclusions</label>
                                    <select class="form-control" id="in_name" name="inc_name" required>
                                        @foreach($inclusions as $quoteinc)
                                        <option value="{{ $quoteinc->pk_in_id }}">{{ $quoteinc->inclusion_Content }}</option>
                                        @endforeach
                                    </select>
                                    <button id="duplicate_inc" class="btn btn-primary my-2">Add</button>
                                    <button id="remove_inc" class="btn btn-danger">Remove</button>
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
                            <div class="form-group col-md-8 mx-2">
                                <label for="quote_exclusions">Exclusions</label>
                                <select class="form-control" id="exc_name" name="exc_name" required>
                                    @foreach($exclusions as $quoteexc)
                                    <option value="{{ $quoteexc->pk_ex_id }}">{{ $quoteexc->exclusion_Content }}</option>
                                    @endforeach
                                </select>    
                                <button id="duplicate_exc" class="btn btn-primary my-2">Add</button>
                                <button id="remove_exc" class="btn btn-danger">Remove</button>
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
                <div class="form-row float-right">
                    <button type="button" class="btn btn-secondary m-2">Cancel</button>
                    <button type="button" class="btn btn-secondary m-2">Save</button>
                    <button type="submit" class="btn btn-primary m-2">Generate Quote</button>
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

    var count = 1; //counter for data-id

    function getSubcategory(element) {  //to get subcategory according to user's select
        optionSelected = element.value;
        number = element.getAttribute("data-id");
        number = number - 1;
        // alert(number);

        // alert(optionSelected);
        
        // alert("aaaaaaaaaa");
        $.ajax({
            url: "getSubcategories/" + optionSelected,
            context: document.body
        }).done(function(data) {

            // alert("data received");
            // alert(data.id);
            // alert(data.name);
            $iteration = 0;

            selectOption = document.getElementsByName('subcategorySelect')[number];
            selectItems = document.getElementsByName('item_number')[number];

            // $('#item_number').find('option').not(':first').remove();
            // $('#subcategorySelect').find('option').not(':first').remove();
            
            // alert(selectOption.options.);
            while (selectOption.firstChild) {
                selectOption.removeChild(selectOption.firstChild);
            }

            while (selectItems.firstChild) {
                selectItems.removeChild(selectItems.firstChild);
            }
            // document.getElementsByName('#subcategorySelect')[number].find('option').not(':first').remove();
            // document.getElementsByName('#item_number')[number].find('option').not(':first').remove();

            data.id.forEach(function(subcategory) {
                option = document.createElement('option');
                option.value = data.id[$iteration];
                option.innerHTML = data.name[$iteration];

                    // alert(option.value + option.innerHTML);
                selectOption.appendChild(option);
                $iteration++;
            });

            document.getElementsByName('item_description')[number].value = "Item Description";

            // option = document.createElement('option');
            // option.value = data.id;
            // option.innerHTML = data.name;
            // document.getElementById('subcategorySelect').appendChild(option);
        });
    }

    function getItem(element) {  //to get item number according to subcategory
        optionSelected = element.value;
        number = element.getAttribute("data-id");
        number = number - 1;

        $('#item_number').find('option').not(':first').remove();

        $.ajax({
            url: "getItems/" + optionSelected,
            context: document.body
        }).done(function(data) {

            $iteration = 0;

            selectItems = document.getElementsByName('item_number')[number];

            var countCheck = 0;
            while (selectItems.firstChild) {
                selectItems.removeChild(selectItems.firstChild);
            }

            data.id.forEach(function(item) {
                option = document.createElement('option');
                option.value = data.id[$iteration];
                option.innerHTML = data.name[$iteration];

                selectItems.appendChild(option);
                $iteration++;
            });

            document.getElementById('item_description')[number].value = "Item Description";
        });
    }

    function getDescription(element) { //to get description according to item number
        optionSelected = element.value;
        number = element.getAttribute("data-id");
        number = number - 1;

        // alert(optionSelected);
        $.ajax({
            url: "getDescription/" + optionSelected,
            context: document.body

        }).done(function(data) {
            // alert(data.id);
            text = document.createTextNode(data.id);
            document.getElementsByName('item_description')[number].value = data.id;
        });
    }

    $(document).ready(function(){   //add and remove the jobs
        $("#dublicate_job").click(function(e){
            e.preventDefault();
            // alert(count);
            count++;
            //alert("new count = " + count);

            var copy = $("#select_job_html").clone(true);
            // copy.attr("id", "select_job_html" + count);
            
            var c = copy.children().children().children().children();
            // var d = copy.children().children().children().children();
            // var txt = "";
            // var i;
            // for (i = 0; i < d.length; i++) {
            //     txt = txt + d[i].tagName + ", ";
            // }

            // alert(txt);
            // alert(c[3].getAttribute('data-id'));

            copy[0].setAttribute('data-id', count);
            c[1].setAttribute('data-id', count);
            c[3].setAttribute('data-id', count);
            c[5].setAttribute('data-id', count);
            c[7].setAttribute('data-id', count);
            c[8].setAttribute('data-id', count);
            
            $("#select_job").append(copy);
        });
    
        $("#remove_job").click(function(e){
            e.preventDefault();
            number = this.getAttribute("data-id");
                // number = number - 1;
                // alert(number);

            section = document.getElementsByName('select_job_html');

            var i;
            var x;
            for (i=0; i<section.length; i++) {
                sectionID = section[i].getAttribute('data-id');
                // alert(sectionID);
                if (sectionID == number) {
                    // alert('match found: ' + sectionID);
                    x = i;
                }
            }

            finalSection = section[x];

            // alert(finalSection.getAttribute('data-id'));
            // $("#select_job").children($("#select_job_html")[number].remove());

            finalSection.remove();
        });
    });

    $(document).ready(function(){  //add and remove the inclusions
        $("#duplicate_inc").click(function(e){
            e.preventDefault();
            $("#select_inc").append($("#select_inc_html").clone(true));
        });

        $("#remove_inc").click(function(e){
            e.preventDefault();
            $("#select_inc").children($("#select_inc_html").remove());
        });
    });
    
    $(document).ready(function(){   //add and remove the exclusions
        $("#duplicate_exc").click(function(e){
            e.preventDefault();
            $("#select_exc").append($("#select_exc_html").clone(true));
        });

        $("#remove_exc").click(function(e){
            e.preventDefault();
            $("#select_exc").children($("#select_exc_html").remove());
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

<!-- 
<script type="text/javascript">
    

    
</script> -->
