@extends('layouts.app')

@section('title', 'Quotes')

@section('content')
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

<div class="p-3 rounded border">
    <div class="row">
        <div class="col-sm">
            <h3>Edit Quote</h3>
            <form method="post" action="{{action('HistoryController@update', $quotesid)}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Quote Status</label>
                         @foreach ($quotes as $quotes)@endforeach
                        <select type="text" class="form-control" id="quote_status" name="quote_status"> 
                            @if ($quotes->quote_status == 1)
                            <option value="{{$quotes->quote_status}}" selected> {{$quotes->quote_status}} </option>
                            <option value="2"> 2 </option>
                            @else
                            <option value="1"> 1 </option>
                            <option value="{{$quotes->quote_status}}" selected> {{$quotes->quote_status}} </option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Quote Comment</label>
                        <input type="text" class="form-control" id="quote_comment" name="quote_comment"
                            value="{{$quotes->quote_comment}}">
                    </div>
                </div>
               
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Archived</label>
                        <select id="quote_archived" name="quote_archived" class="form-control">
                            @if ($quotes->quote_archived == 0)
                            <option value="0" selected>No</option>
                            <option value="1">Yes</option>
                            @else
                            <option value="0">No</option>
                            <option value="1" selected>Yes</option>
                            @endif
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <a class="btn btn-secondary" href="{{url('/history')}}">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
@stop
