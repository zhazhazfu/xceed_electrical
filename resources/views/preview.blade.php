@extends('layouts.previewapp')


 @section('content') 
<!-- --------------- -->

<style>
    
    .container {
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
        margin-right: auto;
        margin-left: auto;
    }

    .rounded {
        border-radius: 0.25rem !important;
    }

    .pt-5,
    .py-5,
    .pr-5,
    .pl-5,
    .pb-5,
    .px-5 {
        padding-left: 2rem !important;
    }

    .mt-5,
    .my-5 {
        margin-top: 3rem !important;
    }

    .mb-4,
    .my-4 {
        margin-bottom: 1.5rem !important;
    }

    .row {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-wrap: wrap;
        flex-wrap: wrap;
        margin-right: -15px;
        margin-left: -15px;
    }

    .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col,
    .col-auto, .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm,
    .col-sm-auto, .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12, .col-md,
    .col-md-auto, .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg,
    .col-lg-auto, .col-xl-1, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl,
    .col-xl-auto {
        position: relative;
        width: 100%;
        padding-right: 15px;
        padding-left: 15px;
    }

    .col-md-4 {
        -ms-flex: 0 0 33.333333%;
        flex: 0 0 33.333333%;
        max-width: 33.333333%;
    } 

    .img-fluid {
        max-width: 100%;
        height: auto;
    }

    .align-middle {
        vertical-align: middle !important;
    }

    .text-right {
        text-align: right !important;
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem;
    }
    
    .text-center {
        text-align: center !important;
    }
    
    .page-break {
        page-break-after: always;
    }

    .table {
        width: 100%;
        margin-bottom: 1rem;
        color: #212529;
    }

    .h3 {
        line-height: 80%;
    }

    .table-sm th,
    .table-sm td {
        padding: 0.3rem;
    }
    
    .table .thead-dark th {
        color: #fff;
        background-color: #343a40;
        border-color: #454d55;
    }

    .font-weight-bold {
        font-weight: 700 !important;
    }
</style>



<html>
    <div class="container rounded border pl-5 pr-5 pb-5 ">
        
        <div class="row">
        
            <div class="col-sm-4 mt-5 pt-5">
                @if (Route::currentRouteName() == "preview")
                    <img src="{{'/storage/Xceed_logo_small_01-copy1.png' }}" class="img-fluid align-middle" width="350px" alt="Responsive image">
                @else
                    <img src="{{ public_path().'/storage/Xceed_logo_small_01-copy1.png' }}" class="img-fluid align-middle" width="350px" alt="Responsive image">
                @endif
            </div>

            <div class="col-sm-4">
            </div>

            <div class="col-sm-4 text-right">
                <p>
                    <h4>{{ $businessDetails->businessdetail_name }}</h4>
                    {{ $businessDetails->businessdetail_addressline1 }}<br>
                    {{ $businessDetails->businessdetail_addressline2 }}<br>
                    {{ $businessDetails->businessdetail_phone }}<br>
                    {{ $businessDetails->businessdetail_fax }}<br>
                    {{ $businessDetails->businessdetail_email }}<br>
                    {{ $businessDetails->businessdetail_website }}
                </p>
                <br>
                @foreach ($quotes as $quote )
                @if ($pageid == $quote->pk_quote_id)
                <h3>Quote Date: {{ $quote->created_at }}</h3>  
                <h4>Quote: {{$quote->prefix->prefix_name }}-{{str_pad($quote->quote_number, 4, '0', STR_PAD_LEFT)}}</h4>  
            </div>
        </div>
        <div class="row">
            <div style="border:1px solid black; padding: 50px 20px 50px 50px; border-radius: 25px;">
                <h1>QUOTATION</h1> 
                <p> Please find enclosed our proposal and estimate for the works to be completed. </p>
                <p>Xceed Electrical is a well-established electrical contracting business. Xceed Electrical has successfully completed many Commercial and Domestic Projects. Our mission is to provide reliable, high quality service, delivered on each and every job. We believe that these are the most important aspects of our customers and should be the cornerstone of our business - a commitment backed-up by the team.</p>
                <p>This estimate enclosed here is good for 30 days.  We will schedule your installation date and finalize the figures after you accept our proposal.  We look forward to working with you.</p>
            </div>
        </div>
            <div class="page-break"></div>
            <div>
                <br>
                <h2 class="mt-3 mb-4">Pricing</h2>
                <p>
                    <h4 class="mt-3 mb-4">Quote : {{$quote->prefix->prefix_name }}-{{str_pad($quote->quote_number, 4, '0', STR_PAD_LEFT)}}</h4>
                    <h4 class="mt-3 mb-4">Customer : {{$quote->customers->customer_name}}</h4>
                </p>
                            
                <table class="display table table-hover table-sm ">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Item Number</th>
                            <th scope="col">Item Description:</th>
                            <!-- <th scope="col">Item Price:</th> -->
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($quotehasitem as $quotehasitem)
                        @foreach ( $items as $item)
                            @if ($quotehasitem->fk_quote_id == $pageid && $item->pk_item_id == $quotehasitem->fk_item_id)
                                {{-- @if ($item->pk_item_id == $quotehasitem->fk_item_id) --}}
                                
                                    <tr>
                                        <td>{{$item->item_number}}</td>
                                        <td>{{$item->item_description}}</td>
                                        <!-- <td><p name="item_price">{{$quotehasitem->item_price}}</p></td> -->
                                    </tr>
                            
                                {{-- @endif --}}
                            @endif
                        @endforeach
                    @endforeach
                    </tbody>
                </table>
                @if ($quotehasitem->fk_quote_id == $pageid)
                    <p class="font-weight-bold"> Sub Total Amount : <p>${{$quotehasitem->price}}</p>
                    <p class="font-weight-bold"> Total Amount : <p>${{$quotehasitem->GST_price}}</p> 
                @endif
                <div class="page-break"></div>
               
                <br>
                <p class="font-weight-bold"><u> Inclusions </u></p>
                <p>{{$quote->inclusions}}</p>

                <p class="font-weight-bold"><u> Exclusions </u></p>
                <p>{{$quote->exclusions}}</p>
                <p>If you have any questions or queries in regard to the above quotation please contact myself on 0415 240 296 or contact the office on 02 9726 4869. All works should be given two weeks' notice prior to commencing works.
                <br>
                <p>Thanks & Regards,<br></p>
                <h3>Jayson Conceicao </h3>

                <div class="page-break"></div>
                <br>
                <br>
                <p class="font-weight-bold"><u> Terms and Conditions </u></p>
                <p>{{$quote->quoteterms->term_body}}</p>

                @endif 
                @endforeach

                <p class="font-weight-bold"><u> Consequential Losses </u></p>
                <p>Notwithstanding any other provision of this contract the liability of the contractor, its servants or agents arising out in any connected with this contract, any indemnity given therein, the relationship established by it or any conduct under or purportedly under it whether arising in contract tort (including negligence) or otherwise, shall in any event be limited to:</p>
                   <p> A)	Such liquidation damages as are payable in accordance with the contract;</p>
                   <p> B)	The cost of repairing or replacing the work or parts thereof;</p>
                   <p> C)	The cost of making good physical loss or damage to other property or the amount of the judgment or payment for or in respect of death or personal injury only to the extent to which the contractor, its servants and agents are in fact indemnified by their insures in respect of such costs, judgment and payment;</p>
                   <p> D)	In no event shall Xceed Electrical be liable under the contract for any loss of profit, loss of revenue, loss of contracts, loss of production or any indirect or consequential loss or damages as appropriate, otherwise shall have no liability whatsoever.</p>
                
                <p class="font-weight-bold"><u>Warranty/ Defects Liability</u></p>
                <p> We guarantee the above installation for a period of 52 weeks against defects attributed to inapt workmanship, and offer the same warranty on materials as offered to us by our supplies.
                    Defects liability and warranty for the works or any portions of the works will commence the date that the works or portions of the works are commissioned.</p>

                <p class="font-weight-bold"><u>Terms of Payment</u></p>
                <p>7 DAYS FROM DATE OF INVIOCE.<p>
                <p>If progress payments are not made in the required time frame works will seized at the cost of Electrical contractor.</p>
                <p>The above works will be carried out under the Building and Construction Security Payments Act of 1999.</p>
                <div class="page-break"></div>

                <p>This Quotation is Subject to the Following Terms and Conditions: </p>
                 <p>- The Client Accepts the Quotation as per listed items Provided</p>
                 <p>- The General Terms and Conditions of Purchase of the above quotation</p>
                 <p>- Client has Read and Understood all Terms and Conditions and Agrees to them</p>
                 <p>- This quotation has been accepted to a form of binding contract upon any of the following:</p>
                      <p>  • Signature Below and Payments to ‘Xceed Electrical & Security’ for the Items listed in this quote to the Expiration date.</p>
                      <p> • Issuance of a Purchase Order to ‘ Xceed Electrical & Security’ referencing this quote and the terms and conditions herein prior.</p> 

                <p class="font-weight-bold"><u>Agreed & Accepted:</u></p>
                <p>Customer/ Company Name:</p>
                <p>_______________________________________________________________________________ </p>
                <p>Name:</p>
                <p>_______________________________________________________________________________ </p>
                <p>Title:</p>
                <p>_______________________________________________________________________________ </p>
                <p>Date: </p>
                <p>_______________________________________________________________________________ </p>
                 
                <p class="font-weight-bold"><u>Banking Details: ( PLEASE REFERNCE YOUR QUOTE NUMBER TO THE DEPOSIT MADE )</u></p>
                <p>St George Bank</p>
                <p>Account name : Xceed Electrical Pty Ltd</p>
                <p>BSB:  112 879</p>
                <p>Account Number:  423 829 911</p>
            </div>
        </div>
    </div>
</html>

<script> 

// counter = 0; 

// function calculatePrice(id, counter) {
//         $.ajax({
//             url: "calculatePrice/" + id,
//             context: document.body
//         }).done(function(data) {
//             section = document.getElementsByName('item_price');
//             section[counter].value = "Item Price: " + data.price;
//             counter++;
//         });

// };

// // document.getElementsByName('item_price')[0].innerHTML = "aaaaaaaaaa";
// document.getElementById('item_price').innerHTML = "aaaaaaaaaa";

// document.onload = aaaaa();

// function aaaaa() {
//     var i;
//     section = document.getElementsByName('item_price');
//     section[0].innerHTML = "aaaa";
//     for (i=0; i<section.length; i++) {
//         // calculatePrice(0,i);
//     }
// }

</script>

@endsection