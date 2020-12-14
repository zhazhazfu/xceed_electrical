@extends('layouts.app')

@section('title', 'Draft list')

@section('content')
<!-- --------------- -->
<html>

<head>
    <title>Draft list fix</title>
</head>

<body>

<h3> Draft list </h3>
<div class="container"> <!-- i will add css for table design later -->
  <div class="row">
    <div class="col-sm-3">Quote ID</div>
    <div class="col-sm-3">Quote Date</div>
    <div class="col-sm-3">Client Name</div>
    <div class="col-sm-3">Description</div>
  </div>
  <div class="row">
    <div class="col-*-*">1846543</div> <!-- testing row -->
    <div class="col-*-*"></div>
    <div class="col-*-*"></div>
  </div>
  <div class="row">
  </div>
</div>
</body>

</html>
@endsection