@extends('layouts.app')

@section('title', 'quotesetting')

@section('content')

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

    <!-- Add material button -->
    <button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal" data-target="#materialModal">
        Add T&C
    </button>


    <!-- Modal -->
    <div class="modal fade" id="materialModal" tabindex="-1" role="dialog" aria-labelledby="materialModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="materialModalLabel">Enter Terms & condition details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ url('quotesetting') }}">
                        {{ csrf_field() }}

                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Terms & condition </label>
                                <input type="text" class="form-control"
                                    name="term_body" placeholder="Enter description"/>

                            </div>
                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save T&C</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End modal -->

   
@stop
