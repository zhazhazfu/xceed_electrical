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
    {{-- <div class="row">
        <div class="col-sm">
            <a href="/{{ 'history' }}" class="list-group-item list-group-item-action bg-light border-0">History</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
                <a href="/{{ 'draftlist' }}" class="list-group-item list-group-item-action bg-light border-0">Draft</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <a href="/{{ 'quoting' }}" class="list-group-item list-group-item-action bg-light border-0">Fix Quote</a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <a href="/{{ 'perpointquote' }}" class="list-group-item list-group-item-action bg-light border-0">Per point quote</a>
        </div>
    </div> --}}


<h1 style = "text-align: center;" class = "display-3">Quote Dashboard</h1>
    <div class="container text-center">
    <div class = "row" style = "padding-left: 180px;">
        <div class="col-xs-5 col-md-5">
        <div class="box1 m-1">
                <a href="/{{ 'history' }}" class="list-group-item list-group-item-action flex-column shadow-lg rounded display-4" style = "height: 200px;">History</a>
        </div>
        <div class="box2 m-1">
                
                <a href="/{{ 'quoting' }}" class="list-group-item list-group-item-action flex-column shadow-lg rounded display-4" style = "height: 200px">Fix Quote</a>
        </div>
        </div>
        <div class="col-xs-5 col-md-5" style = "margin-left: -30px;">
        <div class="box3 m-1">
            <a href="/{{ 'draftlist' }}" class="list-group-item list-group-item-action flex-column shadow-lg rounded display-4" style = "height: 200px;">Draft</a>
        </div>
        @if (Auth::user() && Auth::user()->role == 'admin')
        <div class="box4 m-1">
                <a href="/{{ 'perpointquote' }}" class="list-group-item list-group-item-action flex-column shadow-lg rounded display-4" style = "height: 200px">Per Point Quote</a>
        </div>

        </div> 
    </div>
    @endif
    </div>
</body>

</html>
@endif
@endsection
