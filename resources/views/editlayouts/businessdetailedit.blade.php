@extends('layouts.app')

@section('title', 'Business Details')

@section('content')
@if (Auth::user() && Auth::user()->role != 'admin')
<div class="mx-auto mt-5" style="width: 200px;">
    <h2>
        Access denied
    </h2>
</div>

@elseif (Auth::user() && Auth::user()->role == 'admin')
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
            <h3>Edit Business Details</h3>
            <form method="post" action="{{action('BusinessDetailController@update', $pk_businessdetail_id)}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="businessdetail_archived" value="0">
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Business name</label>
                        <input type="text" class="form-control" id="businessdetail_name" name="businessdetail_name"
                            value="{{$businessDetails->businessdetail_name}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Address line 1</label>
                        <input type="text" class="form-control" id="businessdetail_addressline1"
                            name="businessdetail_addressline1"
                            value="{{$businessDetails->businessdetail_addressline1}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Address line 2</label>
                        <input type="text" class="form-control" id="businessdetail_addressline2"
                            name="businessdetail_addressline2"
                            value="{{$businessDetails->businessdetail_addressline2}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Phone</label>
                        <input type=text" class="form-control" id="businessdetail_phone" name="businessdetail_phone"
                            value="{{$businessDetails->businessdetail_phone}}">
                    </div>
                    <div class="form-group col-sm">
                        <label for="input">Fax</label>
                        <input type="text" class="form-control" id="businessdetail_fax" name="businessdetail_fax"
                            value="{{$businessDetails->businessdetail_fax}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Email</label>
                        <input type="email" class="form-control" id="businessdetail_email" name="businessdetail_email"
                            value="{{$businessDetails->businessdetail_email}}">
                    </div>
                    <div class="form-group col-sm">
                        <label for="input">Website</label>
                        <input type="text" class="form-control" id="businessdetail_website"
                            name="businessdetail_website" value="{{$businessDetails->businessdetail_website}}">
                    </div>
                </div>
                <div class="form-group">
                    <a class="btn btn-secondary" href="{{url('/businessdetails')}}">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@stop
