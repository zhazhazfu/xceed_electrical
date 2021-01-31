@extends('layouts.app')

@section('title', 'Draft list')

@section('content')
<!-- --------------- -->
<html>
<div class=" p-3 mb-5 bg-white rounded border">
<head>
    <title>Draft list fix</title>
</head>

<body>
<h3> Draft list</h3>
<div class="table-responsive">
          <table id="active_table" class="table table-hover table-sm">
              <thead class="thead-dark">
                  <tr>
                      <th scope="col">Quote Number</th>
                      <th scope="col">Quote Date</th>
                      <th scope="col">Client Name</th>
                      <th scope="col">Comment</th>
                      <th scope="col"></th>
                  </tr>
              </thead>
              <tbody>
                  @foreach($quotes as $quote)
                        <tr>
                            <td>{{ $quote->prefix->prefix_name }}-{{str_pad($quote->quote_number, 4, '0', STR_PAD_LEFT)}}</td>
                            <td>{{$quote->created_at}}</td>
                            <td>{{$quote->customers->customer_name}}</td>
                            <td>{{$quote->quote_comment}}</td>
                            <td>
                            <a href="{{url('/draftlist/edit/'.$quote->pk_quote_id )}}" class="btn btn-primary badge-pill" style="width:80px;">edit</a>
                            <button type="button" class="btn btn-danger badge-pill"style="width:80px;">Delete</button>
                            </td>
                        </tr>
                  @endforeach
              </tbody>
          </table>
      </div>


</body>
</div>

</html>
@endsection