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
        <div class="col-xs-5 col-md-5" style = "margin-left: -20px;">
        <div class="box1 m-1">
            <a href="/{{ 'inclusions' }}" class="list-group-item list-group-item-action flex-column shadow-lg rounded display-4" style = "height: 200px;">Inclusions</a>
        </div>
        </div>
        <div class="col-xs-5 col-md-5" style = "margin-left: 0px;">
        <div class="box3 m-1">
            <a href="/{{ 'exclusions' }}" class="list-group-item list-group-item-action flex-column shadow-lg rounded display-4" style = "height: 200px;">Exclusions</a>
        </div>
        </div>
        <div class="col-xs-5 col-md-5" style = "margin-left: 165px; margin-top: -100px;">
        <div class="box3 m-1">
            <a href="/{{ 'termsconditions' }}" class="list-group-item list-group-item-action flex-column shadow-lg rounded display-4" style = "height: 200px;">Terms & Conditions</a>
        </div>
        </div>
    </div>
    </div>
    </div>
</body>

</html>
@endif
@endsection
