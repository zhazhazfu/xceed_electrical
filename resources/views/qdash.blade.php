@extends('layouts.app')

@section('title', 'Quote Dashboard')

@section('content')
<!-- --------------- -->
<html>

<head>
    <title>Quote Dashboard</title>
</head>

<body>
    
    <div class="container">
        <div class="row">
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
        </div>    
    </div>
    
</body>

</html>
@endsection
