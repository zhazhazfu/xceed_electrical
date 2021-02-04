@extends('layouts.app')

@section('title', 'History')

@section('content')
<!-- --------------- -->
<div class=" p-3 mb-5 bg-white rounded border">
    <div>
        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        @if(\Session::has('success'))
        <div class="alert alert-success">
            <p>{{ \Session::get('success') }}</p>
        </div>
        @endif
    </div>

    <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
        <label class="btn btn-secondary active">
            <input type="radio" name="options" id="active" autocomplete="off" checked> Active
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="options" id="archived" autocomplete="off"> Deleted
        </label>
    </div>


    <div id="active_div">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">History</p>
            </div>
            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="active_input" onkeyup="searchHistory()"
                    placeholder="Search from history">
            </div>
        </div>

        <div class="table-responsive-md">
            <table id="active_table" class="display table table-hover table-sm mt-1">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Quote Number</th>
                        <th scope="col">Quote Date</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr> 
                    </thead>
                <tbody>
                    @foreach($quotes as $quote)
                        @if ($quote->quote_archived == '0')
                            <tr width="100%">
                                <td width="7%"><h5>{{$quote->prefix->prefix_name}}-{{str_pad($quote->quote_number, 4, '0', STR_PAD_LEFT)}}</h5></td>
                                <td width="8%">{{$quote->created_at}}</td>
                                <td width="10%">{{$quote->customers->customer_name}}</td>
                                <td width="45   %"><input type="text" class="w-100 form-control ordercomment{{$quote->pk_quote_id}}" id="comment" value="{{$quote->quote_comment}}" ></td>
                                <td width="10%"> 
                                    <select class="form-control w-100 select orderStatus{{$quote->pk_quote_id}}" id="inputGroupSelect01">
                                        <option <?php if($quote->quote_status == "1") echo 'selected'; ?> value="1">To Do</option>
                                        <option <?php if($quote->quote_status == "2") echo 'selected'; ?> value="2">Pending</option>
                                        <option <?php if($quote->quote_status == "3") echo 'selected'; ?> value="3">Sent</option>
                                    </select>
                                </td>
                                <td class="float-right">
                                    <a href="{{ url('/preview/'.$quote['pk_quote_id']) }}" class="btn btn-primary">View</a>
                                    <a href="{{ url('/history/'.$quote['pk_quote_id'].'/edit') }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ url('/preview/'.$quote['pk_quote_id']."/download") }}" class="btn btn-success"> Generate PDF </a>
                                    <button class="btn btn-success statusChange" value="{{$quote->pk_quote_id}}">Save</button>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div id="archived_div" style="display: none">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Delete History</p>
            </div>
            <div class="col-sm-5">
                <input type="text" class="form-control float-left" id="active_input" onkeyup="searchHistory()"
                    placeholder="Search from history">
            </div>
        </div>

        <div class="table-responsive-md">
            <table id="active_table" class="display table table-hover table-sm mt-1">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Quote Number</th>
                        <th scope="col">Quote Date</th>
                        <th scope="col">Client Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr> 
                </thead>
                <tbody>
                    @foreach($quotes as $quote)
                        @if ($quote->quote_archived == '1')
                        <tr width="100%">
                            <td width="7%"><h5>{{$quote->prefix->prefix_name}}-{{str_pad($quote->quote_number, 4, '0', STR_PAD_LEFT)}}</h5></td>
                            <td width="8%">{{$quote->created_at}}</td>
                            <td width="10%">{{$quote->customers->customer_name}}</td>
                            <td width="50%"><input type="text" class="w-100 form-control ordercomment{{$quote->pk_quote_id}}" id="comment" value="{{$quote->quote_comment}}" ></td>
                            <td width="10%"> 
                                <select class="form-control w-100 select orderStatus{{$quote->pk_quote_id}}" id="inputGroupSelect01">
                                    <option <?php if($quote->quote_status == "1") echo 'selected'; ?> value="1">To Do</option>
                                    <option <?php if($quote->quote_status == "2") echo 'selected'; ?> value="2">Pending</option>
                                    <option <?php if($quote->quote_status == "3") echo 'selected'; ?> value="3">Sent</option>
                                </select>
                            </td>
                            <td class="float-right">
                                <a href="{{ url('/preview/'.$quote['pk_quote_id']) }}" class="btn btn-primary">View</a>
                                <a href="{{ url('/history/'.$quote['pk_quote_id'].'/edit') }}" class="btn btn-primary">Edit</a>
                                <a href="{{ url('/preview/'.$quote['pk_quote_id']."/download") }}" class="btn btn-success"> Generate PDF </a>
                                <button class="btn btn-success statusChange" value="{{$quote->pk_quote_id}}">Save</button>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

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