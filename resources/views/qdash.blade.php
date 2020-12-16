@extends('layouts.app')

@section('title', 'Quote Dashboard')

@section('content')
<!-- --------------- -->
<html>

<head>
    <title>Quote Dashboard</title>
</head>

<style>
h1 {
    font-family: Arial;
    color: grey;
    -webkit-text-stroke: 2px black;
}
.box1, .box3 {
    padding-top: 150px;
}
</style>

<body>
<h1 style = "text-align: center;" class = "display-3">Quote Dashboard</h1>
    <div class="container text-center">
    <div class = "row" style = "padding-left: 180px;">
        <div class="col-xs-5 col-md-5">
        <div class="box1">
                <a href="/{{ 'history' }}" class="list-group-item list-group-item-action flex-column shadow-lg rounded display-4" style = "height: 200px;">History</a>
        </div>
        <div class="box2">
                <a href="/{{ 'draftlist' }}" class="list-group-item list-group-item-action flex-column shadow-lg rounded display-4" style = "height: 200px;">Draft</a>
        </div>
        </div>
        <div class="col-xs-5 col-md-5" style = "margin-left: -30px;">
        <div class="box3">
                <a href="/{{ 'quoting' }}" class="list-group-item list-group-item-action flex-column shadow-lg rounded display-4" style = "height: 200px">Fix Quote</a>
        </div>
        <div class="box4">
                <a href="/{{ 'perpointquote' }}" class="list-group-item list-group-item-action flex-column shadow-lg rounded display-4" style = "height: 200px">Per point quote</a>
        </div>
        </div> 
    </div>
    </div>
</body>

</html>
@endsection
