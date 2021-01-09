@extends('layouts.app')

@section('title', 'Preview')

@section('content')
<!-- --------------- -->
<style>
 


</style>
<head>
    <title>Preview</title>
</head>

<h1> Preview </h1>
<html>
<div class="container rounded border pl-5 pr-5 pb-5 ">
    
    <div class="row">
     
     <div class="col-sm-4 mt-5 pt-5">
            <img  src="images/Xceed_logo_small_01-copy1.png" class="img-fluid align-middle" width="350px" 
                alt="Responsive image">
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
            <h2 class="mt-3 mb-4">Quote : #quoteNumber</h2>
    </div>

        <div>
                <h2 class="mt-3 mb-4">QUOTATION</h2>  
           </div>
           <div class= "container rounded border pl-5 pr-5 pb-5" >
            <h3 class = "text-center"> #QuoteName #ClientOrderNumber </h3>
            <p> Please find enclosed our proposal and estimate for the works to be completed. </p>
            <p>Xceed Electrical is a well-established electrical contracting business. Xceed Electrical has successfully completed many Commercial and Domestic Projects. Our mission is to provide reliable, high quality service, delivered on each and every job. We believe that these are the most important aspects of our customers and should be the cornerstone of our business - a commitment backed-up by the team.</p>
            <p>This estimate enclosed here is good for 30 days.  We will schedule your installation date and finalize the figures after you accept our proposal.  We look forward to working with you.</p>
        </div>

             <div>

             <h3 class="mt-3 mb-4">Pricing</h3>
             <p>
             <h4 class="mt-3 mb-4">Quote : #quoteNumber</h4>
             <h4 class="mt-3 mb-4">Customer : #SiteContactFullName</h4>
             </p>

             <p> #quote description </p>

            <p><b> Sub Toatal Amount : </b></p>
            <p><b> GST :            </b></p>
            <p><b> Total Amount :   </b></p> 

             
            <p><b><u> Inclusions </u></b></p>
            #dummy data

            <p><b><u> <br> Exclusions <br> </u></b>
            <br>#dummy data<br> </p>


             <p><br>If you have any questions or queries in regard to the above quotation please contact myself on 0415 240 296 or contact the office on 02 9726 4869. All works should be given two weeks' notice prior to commencing works.<br>

             <br>Thanks & Regards,<br>
             <br>  Jayson Conceicao <br></p>
             </div>

            

</div>
        
<body>

 <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
</div>

<body>

</html>
@endsection
