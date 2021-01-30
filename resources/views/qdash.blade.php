@extends('layouts.app')

@section('title', 'Quote Dashboard')

@section('content')
<!-- --------------- -->
@if (Auth::user())
<html>

<head>
    <title>Quote Dashboard</title>
</head>

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

<body>
<div class=" p-3 bg-white rounded border">

    <h3>Quote Dashboard</h3>
    <br>
    <div class = "py-5 form-row d-flex justify-content-center">
            <a href="/{{ 'inclusions' }}" class="p-5 m-2 btn btn-outline-xceed w-75"> <h2> Inclusions </h2> </a>
            <a href="/{{ 'exclusions' }}" class="p-5 m-2 btn btn-outline-xceed w-75"> <h2> Exclusions </h2></a>
            <a href="/{{ 'termsconditions' }}" class="p-5 m-2 btn btn-outline-xceed w-75"> <h2> Terms & Conditions </h2></a>
            <a href="/{{ 'prefix' }}" class="p-5 m-2 btn btn-outline-xceed w-75"> <h2> Quote Prefixes </h2></a>
    </div>
    
</div>
</body>


</html>
@endif
@endsection
