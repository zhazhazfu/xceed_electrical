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
                <h2 class="mt-3 mb-4">Pricing</h2>
                <p>
                    <h4 class="mt-3 mb-4">Quote : {{$quote->prefix->prefix_name }}-{{str_pad($quote->quote_number, 4, '0', STR_PAD_LEFT)}}</h4>
                    <h4 class="mt-3 mb-4">Customer : {{$quote->customers->customer_name}}</h4>
                </p>
                            
                <p class="font-weight-bold">Items</p>
                <table class="display table table-hover table-sm mt-1">
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
                        </tbody>
                        </table>
                                {{-- <p class="font-weight-bold"> Item Number : <p>${{$item->item_number}}</p>
                                <p class="font-weight-bold"> Item Description: <p>{{$item->item_description}}</p>
                                <p class="font-weight-bold"> Item Price: <p>{{$quotehasitem->item_price}}</p> --}}
                            @endif
                        @endif
                        <br>
                    @endforeach
                @endforeach

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

                <p class="font-weight-bold"><u> Terms and Conditions </u></p>
                {{-- @forEach($quoteterms as $quoteterm)@endforeach --}}
                <p>{{$quote->quoteterms->term_body}}</p>

                <p>If you have any questions or queries in regard to the above quotation please contact myself on 0415 240 296 or contact the office on 02 9726 4869. All works should be given two weeks' notice prior to commencing works.
                <br>
                <p>Thanks & Regards,<br></p>
                <p>Jayson Conceicao </p>
            </div>
            @endif 
            @endforeach
        </div>
    </div>
</html>
@endsection