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

      <div class="table-responsive-md">
          {{-- <table id="active_table" class="table table-hover" class="table-responsive"> --}}
          <table id="active_table" class="display table table-hover table-sm mt-1">
              <thead class="thead-dark ">
                  <tr>
                      <th scope="col">Quote Number</th>
                      <th scope="col">Quote Date</th>
                      <th scope="col">Client Name</th>
                      <th scope="col">Description</th>
                      <th scope="col">Comment</th>
                      {{-- <th scope="col">Type</th> --}}
                      <th scope="col">Status</th>
                      <th scope="col"></th>
                  </tr> 
                </thead>
              <tbody>
                  @foreach($quotes as $quote)
                        <tr>
                            <td>{{$quote->prefix->prefix_name}}-{{str_pad($quote->quote_number, 4, '0', STR_PAD_LEFT)}}</td>
                            <td>{{$quote->created_at}}</td>
                            <td>{{$quote->customers->customer_name}}</td>
                            <td></td>
                            {{-- <td>{{$quote->quote_comment}}</td>  --}}
                            {{-- <td>@switch($quote->quote_status)
                                    @case(1)
                                        <span>To sent</span>
                                        @break
                                    @case(2)
                                        <span>Sent</span>
                                        @break
                                    @default
                                @endswitch
                            </td> --}}
                            <td><input type="text" class="form-control col-md-6 ordercomment{{$quote->pk_quote_id}}" id="comment" value="{{$quote->quote_comment}}" ></td>
                            {{-- <td> {{$quote->type}}</td> --}}
                            <td > 
                                <select class="col-2-lg select orderStatus{{$quote->pk_quote_id}}" id="inputGroupSelect01">
                                    <option <?php if($quote->quote_status == "2") echo 'selected'; ?> value="2">todo</option>
                                    <option <?php if($quote->quote_status == "1") echo 'selected'; ?> value="1">sent</option>
                                </select>
                            </td>
                            <td>
                                <a href="{{ url('/preview/'.$quote['pk_quote_id']) }}" class="btn btn-primary badge-pill">View</a>
                                <a href="{{ url('/history/'.$quote['pk_quote_id'].'/edit') }}" class="btn btn-primary badge-pill">Edit</a>
                                <a href="{{ url('/preview/'.$quote['pk_quote_id']."/download") }}" class="btn btn-success"> Generate PDF </a>
                                <button class="btn btn-success badge-pill statusChange" value="{{$quote->pk_quote_id}}">Save</button>
                           </td>
                        </tr>
                  @endforeach
              </tbody>
              
          </table>
      </div>
  </body>

</html>
@endsection

@push('js')
<script type="text/javascript">
                    
    $(document).ready(function(){ 
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            } });
                        $(".statusChange").click(function(e){
                            e.preventDefault();
                             var id = $(this).val();  
                             var value = $('.orderStatus'+id).val();
                             var comment = $('.ordercomment'+id).val(); 
                             console.log(value); 
                             var container = $('.tableDiv');
                           
                    
                            $.ajax({
                    
                               type:'POST',
                    
                               url:'{{ URL::to('/quoteStatus') }}',
                               
                    
                               data:{ value: value,id: id,comment: comment},
                                
                               success:function(data){
                                  alert("Quote Updated");
                               },
                              
                                error:function(data){alert("try again");}
                            });
                      }); 

                }); 

</script>
                        
                    

@endpush