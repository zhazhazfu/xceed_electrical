@extends('layouts.app')

@section('title', 'Quoting')

@section('content')

@if (Auth::user() && Auth::user()->role != 'admin')
<div class="mx-auto mt-5" style="width: 200px;">
    <h2>
        Access denied
    </h2>
</div>

@elseif (Auth::user() && Auth::user()->role == 'admin')
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
        <form method="post" action={{url('quoting')}}>
            {{ csrf_field() }}
            <div class="col-sm-6 pb-2">
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
                        <label for="input">Quote Prefix</label>
                        {{-- <input class="form-control" id="quote_prefix" name="quote_prefix" value="2" hidden required> --}}
                        <select class="form-control" id="quote_prefix" name="quote_prefix" required>
                            @foreach($prefixes as $prefix)
                            <option value="{{ $prefix->pk_prefix_id }}">{{ $prefix->prefix_name}}</option>
                            @endforeach
                        </select>
                            {{-- @foreach (App\Quote::all() as $quotes )  --}}
                        @foreach ($quotes as $quote ) 
                            <label for="quoteNumber"></label>
                            <input type="hidden" class="form-control" name="quote_number" id="quote_number" value="{{ $quote->prefix->prefix_name }}-{{str_pad($quote->quote_number, 4, '0', STR_PAD_LEFT)}}" readonly>
                        @endforeach

                        {{-- <label for="quoteNumber"></label>
                        <input type="hidden" class="form-control" name="quote_number" id="quote_number" value="{{$quote->prefix->prefix }}-{{str_pad($quote->quote_number, 4, '0', STR_PAD_LEFT)}}" readonly>   --}}
                    </div>
                    <div class="form-group col-md-6">
                        <label for="quoteDate">Date</label>
                        <input type="date" class="form-control" id="today" value="" readonly>
                    </div>
                </div>
            </div>
        
            <div class="w-100 border-top"></div>
            <div id="select_job">
                <h5 class="pt-3 pb-1">Job</h5>
                <div data-id="1" name="select_job_html" id="select_job_html">
                    <div class="col-sm-12 pb-2">
                        <div class="form-row">
                            <div class="form-group col-md-3">
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
                            <div class="form-group col-md-7">
                                <label for="selectCategory">Sub-Category</label>
                                <select data-id="1" class="form-control" id="subcategorySelect" name="subcategorySelect" onchange="getItem(this)">
                                    <option value="" selected disabled>Please select a subcategory</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <label for="selectItemNumber">Item Code</label>
                                <select data-id="1" class="form-control" id="item_number" name="item_number[]" onchange="getDescription(this)">
                                    <option value="" selected disabled>Please select an item</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-8" id="description">
                                <input data-id="1" type="text" class="form-control" name="item_description" id="item_description" placeholder="Item Description" readonly>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4" id="description">
                                <input data-id="1" type="number" class="form-control" name="item_price" id="item_price" placeholder="$0.00" readonly>
                            </div>
                            <div class="form-group col-md-2">
                                <input data-id="1" type="text" class="form-control" id="item_quantity" name="item_quantity[]" placeholder="Quantity of item"  onkeyup="getQuantity(this)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <button data-id="1" id="dublicate_job" class="btn btn-primary">Add Job</button>
                            </div>
                            <div class="form-group col-sm float-right">
                                <button data-id="1" id="remove_job" class="btn btn-danger float-right">Remove Job</button>
                            </div>
                            <div class="form-group col-sm float-right">
                                <input data-id="1" type="hidden" class="form-control" name="fix_item_price" id="fix_item_price" placeholder="$0.00" readonly>
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
                            <input type="text" class="form-control price_input" id="inlineFormInputGroup" name="price"
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
                            <input type="text" class="form-control gst_input" id="inlineFormInputGroup" name="gst_price"
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

                                    <textarea class="form-control" id="inc_name" name="inc_name" rows="5" ></textarea>
                                    
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

                                <textarea class="form-control" id="exc_name" name="exc_name" rows="5" ></textarea>

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
                        <select class="form-control" id="term_name" name="term_name" required>
                            @foreach($quoteterms as $quoteterm)
                            <option value="{{ $quoteterm->pk_term_id }}">{{ $quoteterm->term_name }}</option>
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
                        <input text="text" class="form-control" id="quote_comment" name="quote_comment" >
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
@endif

<!-- Sets todays date as the quote date -->
<script>
    let today = new Date().toISOString().substr(0, 10);
    document.querySelector("#today").value = today;
    document.querySelector("#today2").valueAsDate = new Date();
</script>
@stop

@push('js')
<script type="text/javascript">
    
    let fk_subcategory_id = $("#my_select").change(function () {
        var id = $(this).children(":selected").attr("id");
    });

    var count = 1; //counter for data-id
    
    function calculateTotal() {
        var id_values = $("select[name='item_number[]']").map(function(){return $(this).val();}).get();
        var qtys = $("input[name='item_quantity[]']").map(function(){return $(this).val();}).get();
        var customer_id = $("select[name='customer_name']").val();
        console.log(qtys);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            } 
        });

        $.ajax({
            type:'POST',
            
            url:'{{ URL::to('/quote_pricings') }}',
                        
            data:{ id_values: id_values, qtys: qtys, customer_id:customer_id},
                        
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
            url: "getSubcategories/" + optionSelected,
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
            document.getElementsByName('item_price')[x].value= "$0.00";
        });
    }

    function getItem(element) {  //to get item number according to subcategory
        optionSelected = element.value;
        number = element.getAttribute("data-id");
        // number = number - 1;
        // alert(number);
        // $('#item_number[]').find('option').not(':first').remove();

        $.ajax({
            url: "getItems/" + optionSelected,
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
            
            document.getElementsByName('item_description')[x].value = "Item Description";
            document.getElementsByName('item_price')[x].value= "$0.00";
            calculateTotal();
        });
    }

    function getQuantity(element) { 
        console.log('working');
         optionSelected = element.value;

       console.log(parseInt(optionSelected)<1);
        if(parseInt(optionSelected)>0)
        {
            number = element.getAttribute("data-id");
            section = document.getElementsByName('item_price');

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
                
                var value = parseFloat(document.getElementsByName('fix_item_price')[x].value) * parseFloat(optionSelected);
                value = value.toFixed(2)
                console.log(document.getElementsByName('item_price')[x].value);
                document.getElementsByName('item_price')[x].value= value;
                calculateTotal();
        }



    }

    function getDescription(element) { //to get description according to item number
        optionSelected = element.value;
        number = element.getAttribute("data-id");

        $.ajax({
            url: "getDescription/" + optionSelected,
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

            document.getElementsByName('item_description')[x].value = data.id;
            document.getElementsByName('item_price')[x].value= "$0.00";
            calculatePrice(optionSelected, x);
            calculateTotal();
        });
    }

    function calculatePrice(id,counter) {
        // alert("calculating price...");
        $.ajax({
            url: "calculatePrice/" + id,
            context: document.body
        }).done(function(data) {
            console.log("price = " + data.price);
            // alert("price = " + data.price);
            section2 = document.getElementsByName('fix_item_price');
            section = document.getElementsByName('item_price');
            
            // alert(data.price);
            section[counter].value = data.price;
            section2[counter].value = data.price;
            // return(data);
        });
    };

    $(document).ready(function(){   //add and remove the jobs
        $("#dublicate_job").click(function(e){
            e.preventDefault();
            // iterate the counter
            count++;
            //alert("new count = " + count);

            // get the section
            var copy = $("#select_job_html").clone(true);

            //reach the children of the section (it's a bit nested)
            var c = copy.children().children().children().children();

            copy[0].setAttribute('data-id', count);
            c[1].setAttribute('data-id', count);
            c[3].setAttribute('data-id', count);
            c[5].setAttribute('data-id', count);
            c[6].setAttribute('data-id', count);
            c[7].setAttribute('data-id', count);
            c[8].setAttribute('data-id', count);
            c[9].setAttribute('data-id', count);
            c[10].setAttribute('data-id', count);
            
            $("#select_job").append(copy);
            calculateTotal();
        });
    
        $("#remove_job").click(function(e){
            e.preventDefault();
            number = this.getAttribute("data-id");

            section = document.getElementsByName('select_job_html');
            var i;
            var x;
            for (i=0; i<section.length; i++) {
                sectionID = section[i].getAttribute('data-id');
                if (sectionID == number) {
                    x = i;
                }
            }

            finalSection = section[x];

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

