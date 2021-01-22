@extends('layouts.app')

@section('title', 'History list')

@section('content')
<!-- --------------- -->
<html>

<head>
    <title>History list </title>
</head>

<body>
<h3> History list</h3>
<div class="table-responsive-sm">
<table class="table table-hover" class="table-responsive">
<thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Quote ID</th>
      <th scope="col">Quote Date</th>
      <th scope="col">Client Name</th>
      <th scope="col">Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>

      <th scope="row">1</th>
      <td>1846453</td>
      <td>12/12/2020</td>
      <td>James Anderson</td>
      <td>Lightning</td>
      <td >
      <button type="button" class="btn btn-primary badge-pill" style="width:80px;">View</button>
      <button type="button" class="btn btn-danger badge-pill"style="width:80px;">Delete</button>
      </td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>1846454</td>
      <td>13/12/2020</td>
      <td>Johnny Thornton</td>
      <td>CCTV</td>
      <td >
      <button type="button" class="btn btn-primary badge-pill" style="width:80px;">View</button>
      <button type="button" class="btn btn-danger badge-pill"style="width:80px;">Delete</button>
      </td>
    </tr>
    <tr>
      <th scope="row">3</th>
      <td>1846455</td>
      <td>13/12/2020</td>
      <td>Sammy John</td>
      <td>Alarms</td>
      <td >
      <button type="button" class="btn btn-primary badge-pill" style="width:80px;">View</button>
      <button type="button" class="btn btn-danger badge-pill"style="width:80px;">Delete</button>
      </td>
    </tr>
  </tbody>
</table>
</div>
</body>

</html>
@endsection