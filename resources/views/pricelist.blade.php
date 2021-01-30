@extends('layouts.app')

@section('title', 'Price List')

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
    <title>Price List</title>
</head>

<body>

<!-- Button trigger modal -->
<div class=" p-3 bg-white rounded border">
<h3> Price List </h3> 
    <a type="button" class="p-2 btn btn-outline-primary" href="/{{ 'categories' }}"> Category Management </h3></a> 
        <div class="py-5 form-row row-cols-5 d-flex justify-content-center">
        <x-sidebarCategories/>   
        </div>
        <!-- 、、、、、、、、、、、、、、、、 -->
</body>

</html>
@endsection
