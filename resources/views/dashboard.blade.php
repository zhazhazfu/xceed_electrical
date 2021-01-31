@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- --------------- -->
<style>
    .btn-outline-xceed {
        color: #004271;
        border-color: #004271;
        transition: all .2s ease-in-out;
    }

    .btn-outline-xceed:hover {
        color: #fff;
        background: linear-gradient(to left, #004271, #94c94a);
        border-color: #004271;
        transform: scale(1.05);

    }


    .btn-warning {
        background: linear-gradient(to right, #f0e07a, #deac57);
        transition: all .2s ease-in-out;
    }

    .btn-warning:hover {
        transform: scale(1.05);
        filter: brightness(120%);
    }

    .btn-success {
        background: linear-gradient(to right, #72cf7b, #3b9457);
        transition: all .2s ease-in-out;
    }

    .btn-success:hover {
        transform: scale(1.05);
        filter: brightness(120%);
    }

    .tint {
        background: #fff;
    }

    .btn-outline-xceed:hover .tint {
        opacity: 1;
    }

    .btn-outline-xceed:focus, .btn-outline-xceed.focus {
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.5);
    }
</style>
<html>

<head>
    <title>Dashboard</title>
</head>

<body>

<!-- Button trigger modal -->
<div class=" p-3 mb-5 bg-white rounded border">
<h3> Dashboard </h3>
    <div class='row w-100'>
        
        <div class="col-3">
            <div class="p-3 mb-5">
                <a href="{{ 'quoting' }}" class=" h-100 w-100 p-4 m-2 btn btn-outline-xceed">
                    <h3 class="float-left"> New Quote </h3>
                </a>
                <a href="{{ 'history' }}" class=" h-100 w-100 p-4 m-2 btn btn-outline-xceed">
                    <h3 class="float-left"> Quote History </h3>
                </a>
                <a href="{{ 'pricelist' }}" class=" h-100 w-100 p-4 m-2 btn btn-outline-xceed">
                    <h3 class="float-left"> Price Lists </h3>
                </a>
                <a href="{{ 'customers' }}" class=" h-100 w-100 p-4 m-2 btn btn-outline-xceed">
                    <h3 class="float-left"> Manage Customers </h3>
                </a>
                <a href="{{ 'materials' }}" class=" h-100 w-100 p-4 m-2 btn btn-outline-xceed">
                    <h3 class="float-left"> Manage Materials </h3>
                </a>
                <a href="{{ 'suppliers' }}" class=" h-100 w-100 p-4 m-2 btn btn-outline-xceed">
                    <h3 class="float-left"> Manage Suppliers </h3>
                </a>
            </div>
        </div>    

        <div class="col-9">
            <div class="row w-100">
                <div class="col">
                    <div class=" p-3 mb-5 bg-white rounded border">
                        <h3 class="text-center"> Pending <h3>

                        <!-- 1 = sent, 2 = to send -->
                        @foreach($quotes as $quote)
                            @if($quote->quote_status == '2')
                            <a href="/{{ 'preview' }}/{{ $quote->pk_quote_id }}" class="btn btn-block btn-warning rounded border" id="quotes" value="{{ $quote->pk_quote_id }}">
                            <h3> #{{$quote->prefix->prefix_name }}-{{str_pad($quote->quote_number, 4, '0', STR_PAD_LEFT)}} </h3>
                            <p> {{$quote->customers->customer_name}} </p>   
                            <p> {{ $quote->quote_comment }} </p>
                            </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <div class="col">
                    <div class=" p-3 mb-5 bg-white rounded border">
                        <h3 class="text-center"> Sent <h3>
                        @foreach($quotes as $quote)
                            @if($quote->quote_status == '1')
                            
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

    </div>
    </div>

        <!-- 、、、、、、、、、、、、、、、、 -->
</body>

</html>
@endsection
