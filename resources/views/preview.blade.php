@extends('layouts.previewapp')


 @section('content') 
<!-- --------------- -->
<html>
    <div class="container rounded border pl-5 pr-5 pb-5 ">
        
        <div class="row">
        
            <div class="col-sm-4 mt-5 pt-5">
                <img src="{{ public_path().'/storage/Xceed_logo_small_01-copy1.png' }}" class="img-fluid align-middle" width="350px" alt="Responsive image">
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
                    @foreach ($quotes as $quote )
                    @if ($pageid == $quote->pk_quote_id)
                    <h2 class="mt-3 mb-4">Quote : {{$quote->prefix->prefix_name }}-{{str_pad($quote->quote_number, 4, '0', STR_PAD_LEFT)}}</h2>  
            </div>
            <div>
                <h1 class="display-3">QUOTATION</h1>  
            </div>
            <div class= "container rounded border pt-5 pl-5 pr-5 pb-5" >
                <p> Please find enclosed our proposal and estimate for the works to be completed. </p>
                <p>Xceed Electrical is a well-established electrical contracting business. Xceed Electrical has successfully completed many Commercial and Domestic Projects. Our mission is to provide reliable, high quality service, delivered on each and every job. We believe that these are the most important aspects of our customers and should be the cornerstone of our business - a commitment backed-up by the team.</p>
                <p>This estimate enclosed here is good for 30 days.  We will schedule your installation date and finalize the figures after you accept our proposal.  We look forward to working with you.</p>
            </div>

            <div>
                <br>
                <h3 class="mt-3 mb-4">Pricing</h3>
                <p>
                    <h4 class="mt-3 mb-4">Quote : {{$quote->prefix->prefix_name }}-{{str_pad($quote->quote_number, 4, '0', STR_PAD_LEFT)}}</h4>
                    <h4 class="mt-3 mb-4">Customer : {{$quote->customers->customer_name}}</h4>
                </p>
                            
                <h3 class="font-weight-bold">Items :</h3>
                <table class="display table table-hover table-sm ">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Item Number</th>
                    <th scope="col">Item Description:</th>
                    <th scope="col">Item Price:</th>
                </tr>
               </thead>
                @foreach ($quotehasitem as $quotehasitem)
                    @foreach ( $items as $item)
                        @if ($quotehasitem->fk_quote_id == $pageid)
                            @if ($item->pk_quote_id == $quote->fk_item_id)
                            <tbody>
                                <tr>
                                    <td>${{$item->item_number}}</td>
                                    <td>{{$item->item_description}}</td>
                                    <td>{{$quotehasitem->item_price}}</td>
                                </tr>
                        
                        
                                {{-- <p class="font-weight-bold"> Item Number : <p>${{$item->item_number}}</p>
                                <p class="font-weight-bold"> Item Description: <p>{{$item->item_description}}</p>
                                <p class="font-weight-bold"> Item Price: <p>{{$quotehasitem->item_price}}</p> --}}
                            @endif
                        @endif
                    @endforeach
                @endforeach
                </tbody>
             </table>

                @if ($quotehasitem->fk_quote_id == $pageid)
                    <p class="font-weight-bold"> Sub Total Amount : <p>${{$quotehasitem->price}}</p>
                    <p class="font-weight-bold"> Total Amount : <p>${{$quotehasitem->GST_price}}</p> 
                @endif
               
                <br>
                <p class="font-weight-bold"><u> Inclusions </u></p>
                {{-- @forEach($inclusion as $inclusion)@endforeach --}}
                <p>#data {{$quote->inclusions}}</p>

                <p class="font-weight-bold"><u> Exclusions </u></p>
                {{-- @forEach($exclusion as $exclusion)@endforeach --}}
                <p>#data {{$quote->exclusions}}</p>

                <p>If you have any questions or queries in regard to the above quotation please contact myself on 0415 240 296 or contact the office on 02 9726 4869. All works should be given two weeks' notice prior to commencing works.
                <br>
                <p>Thanks & Regards,<br></p>
                <p>Jayson Conceicao </p>
                
                <br><br>
                <p class="font-weight-bold"><u> Terms and Conditions </u></p>
                {{-- @forEach($quoteterms as $quoteterm)@endforeach --}}
                <p>{{$quote->quoteterms->term_body}}</p>

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
                <p>The above works will be carried out under the building and construction security payments act of 1999.</p>

                <p>This Quotation is Subject to the Following Terms and Conditions: </p>
                 <p>- The Client Accepts the Quotation as per listed items Provided</p>
                 <p>- The General Terms and Conditions of Purchase of the above quotation</p>
                 <p>- Client has Read and Understood all Terms and Conditions and Agrees to them</p>
                 <p>- This quotation has been accepted to a form of binding contract upon any of the following:</p>
                      <p>  • Signature Below and Payments to ‘Xceed Electrical & Security’ for the Items listed in this quote to the Expiration date.</p>
                      <p> • Issuance of a Purchase Order to ‘ Xceed Electrical & Security’ referencing this quote and the terms and conditions herein prior.</p> 

                <p class="font-weight-bold"><u>Agreed & Accepted:</u></p>
                <p>Customer/ Company Name:</p>
                <p>______________________ </p>
                <p>Name:</p>
                <p>______________________ </p>
                <p>Title:</p>
                <p>______________________ </p>
                <p>Date: </p>
                <p>______________________ </p>
                 
                <p>Banking Details: ( PLEASE REFERNCE YOUR QUOTE NUMBER TO THE DEPOSIT MADE )</p>
                <p>St George Bank</p>
                <p>Account name : Xceed Electrical Pty Ltd</p>
                <p>BSB:  112 879</p>
                <p>Account Number:  423 829 911</p>
            </div>
            @endif 
            @endforeach
        </div>
    </div>
</html>
@endsection