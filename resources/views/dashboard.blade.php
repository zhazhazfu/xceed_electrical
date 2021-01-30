@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- --------------- -->
<html>

<head>
    <title>Dashboard</title>
</head>

<body>

<!-- Button trigger modal -->
<div class=" p-3 mb-5 bg-white rounded border">
<h3> Dashboard </h3>
    <div class='row w-50'>
        <div class="col-md-6">
            <div class=" p-3 mb-5 bg-white rounded border">
                <h3 class="text-center"> Pending <h3>

                <!-- 1 = to send, 2 = sent -->
                @foreach($quotes as $quote)
                    @if($quote->quote_status == '1')
                    
                    <a href="/{{ 'preview' }}/{{ $quote->pk_quote_id }}" class="btn btn-block btn-warning rounded border" id="quotes" value="{{ $quote->pk_quote_id }}">
                    <h3> #{{$quote->prefix->prefix_name }}-{{str_pad($quote->quote_number, 4, '0', STR_PAD_LEFT)}} </h3>
                    <p> {{$quote->customers->customer_name}} </p>   
                    <p> {{ $quote->quote_comment }} </p>
                    </a>

                    @endif
                @endforeach

                <!-- <div class="btn btn-block btn-warning rounded border">
                    <h3> #example </h3>
                    <p> Customer Name </p>
                    <p> Job names </p>
                </div> -->

                
            </div>
        </div>
        <div class="col-md-6">
            <div class=" p-3 mb-5 bg-white rounded border">
                <h3 class="text-center"> Sent <h3>
                @foreach($quotes as $quote)
                    @if($quote->quote_status == '2')
                    
                    <a href="/{{ 'preview' }}/{{ $quote->pk_quote_id }}" class="btn btn-block btn-success rounded border" id="quotes" value="{{ $quote->pk_quote_id }}">
                    <h3> #{{$quote->prefix->prefix_name }}-{{str_pad($quote->quote_number, 4, '0', STR_PAD_LEFT)}} </h3>
                    <p> {{$quote->customers->customer_name}} </p>   
                    <p> {{ $quote->quote_comment }} </p>
                    </a>

                    @endif
                @endforeach
            </div>
        </div>
        
    </div>
    </div>

        <!-- 、、、、、、、、、、、、、、、、 -->
</body>

</html>
@endsection
