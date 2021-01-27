@extends('layouts.app')

@section('title', 'History list')

@section('content')
<!-- --------------- -->
<html>

  <head>
      <title>History list </title>
  </head>

  <body>
      <div class="row mb-4">
          <div class="col-sm-7">
              <p class="h2">History list</p>
          </div>
          <div class="col-sm-5">
              <input type="text" class="form-control float-left" id="active_input" onkeyup="searchHistory()"
                  placeholder="Search from history">
          </div>
      </div>

      <div class="table-responsive-sm">
          <table id="active_table" class="table table-hover" class="table-responsive">
              <thead>
                  <tr>
                      <th scope="col">Quote Number</th>
                      <th scope="col">Quote Date</th>
                      <th scope="col">Client Name</th>
                      <th scope="col">Description</th>
                      <th scope="col">Type</th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($quotes as $quote)
                        <tr>
                            <td>{{ $quote->prefix->prefix_name }}-{{str_pad($quote->quote_number, 4, '0', STR_PAD_LEFT)}}</td>
                            <td>{{$quote->created_at}}</td>
                            <td>{{$quote->customers->customer_name}}</td>
                            <td>{{$quote->quote_comment}}</td>
                            <td>{{$quote->type}}</td>
                            <td>
                            <button type="button" class="btn btn-primary badge-pill" style="width:80px;">View</button>
                            <button type="button" class="btn btn-danger badge-pill"style="width:80px;">Delete</button>
                            </td>
                        </tr>
                  @endforeach
              </tbody>
          </table>
      </div>
  </body>

</html>
@endsection