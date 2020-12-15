@extends('layouts.app')

@section('title', 'Price List')

@section('content')
<!-- --------------- -->
    <style>
        .btn-outline-xceed {
    color: #004271;
    border-color: #004271;
    }

    .btn-outline-xceed:hover {
    color: #fff;
    background: linear-gradient(to right, #004271, #94c94a);
    border-color: #004271;
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
<h3> Price List <a type="button" class="p-2 btn btn-outline-primary" href="/{{ 'categories' }}"> Category Management </h3></a> </h3> 
        <div class="p-4 form-row row-cols-5">
        <x-sidebarCategories/>   
        </div>
        
        <!-- 、、、、、、、、、、、、、、、、 -->
</body>

</html>
@endsection
