@extends('layouts.app')

@section('title', 'Admin Dash')

@section('content')
<!-- --------------- -->
<style>
    
</style>

<html>

<head>
    <title>Admin Dash</title>
</head>

<body>

    <div class="container">
        <div class="row">
          <div class="col-sm">
            <a href="/{{ 'totalcosts' }}" class="list-group-item list-group-item-action bg-light border-0">Total Cost</a>
          </div>
          <div class="col-sm">
            <a href="/{{ 'employeecosts' }}" class="list-group-item list-group-item-action bg-light border-0">employeecosts</a>
          </div>
          <div class="col-sm">
            <a href="/{{ 'companycosts' }}" class="list-group-item list-group-item-action bg-light border-0">companycosts</a>
          </div>
          <div class="col-sm">
            <a href="/{{ 'discounts' }}" class="list-group-item list-group-item-action bg-light border-0">discounts</a>
          </div>
        </div>
        
        <div class="row">
            <div class="col-sm">
              <a href="/{{ 'users' }}" class="list-group-item list-group-item-action bg-light border-0">User management</a>
            </div>
            <div class="col-sm">
              <a href="/{{ 'adminqdash' }}" class="list-group-item list-group-item-action bg-light border-0">Quote Managment</a>
            </div>
            <div class="col-sm">
              <a href="/{{ 'businessdetails' }}" class="list-group-item list-group-item-action bg-light border-0">Business Datail</a>
            </div>
          </div>
      </div>

</body>

</html>
@endsection