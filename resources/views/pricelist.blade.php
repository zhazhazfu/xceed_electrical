@extends('layouts.app')

@section('title', 'Price List')

@section('content')
<!-- --------------- -->
<html>

<head>
    <title>Price List</title>
</head>

<body>

<!-- Button trigger modal -->
<div class=" p-3 bg-white rounded border">
<h3> Price List <a type="button" class="p-2 btn btn-outline-primary" href="/{{ 'categories' }}"> Category Management </h3></a> </h3> 
        <div class="p-4 form-row row-cols-4">
            
        <x-sidebarCategories/>   
        </div>
        
        <!-- 、、、、、、、、、、、、、、、、 -->
</body>

</html>
@endsection
