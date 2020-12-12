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
<!-- Button trigger modal -->
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

    <div class='table-responsive'>
        <p class="h2 mb-4">Business Details</p>
        <table id="business_details_table" class="display table table-hover table-sm mt-1">
            <thead>
                <tr>
                    <th scope="col">Business Name</th>
                    <th scope="col">Address Line 1</th>
                    <th scope="col">Address Line 2</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Fax</th>
                    <th scope="col">Email</th>
                    <th scope="col">Website</th>
                    <th scope="col">Edit</th>
                </tr>
            </thead>
            <tbody>
                @foreach($businessDetails as $businessDetail)
                <tr>
                    <td>{{ $businessDetail->businessdetail_name }}</td>
                    <td>{{ $businessDetail->businessdetail_addressline1 }}</td>
                    <td>{{ $businessDetail->businessdetail_addressline2 }}</td>
                    <td>{{ $businessDetail->businessdetail_phone }}</td>
                    <td>{{ $businessDetail->businessdetail_fax }}</td>
                    <td>{{ $businessDetail->businessdetail_email }}</td>
                    <td>{{ $businessDetail->businessdetail_website }}</td>
                    <td><a
                            href="{{action('BusinessDetailController@edit', $businessDetail['pk_businessdetail_id'])}}">Edit</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@stop
