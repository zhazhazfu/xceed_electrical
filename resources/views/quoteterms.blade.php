@extends('layouts.app')

@section('title', 'Quote Terms')

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

    <button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal" data-target="#quoteTermModal">
        Add Quote Terms
    </button>

    <div class="btn-group btn-group-toggle float-right" data-toggle="buttons">
        <label class="btn btn-secondary active">
            <input type="radio" name="options" id="active" autocomplete="off" checked> Active
        </label>
        <label class="btn btn-secondary">
            <input type="radio" name="options" id="archived" autocomplete="off"> Archived
        </label>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="quoteTermModal" tabindex="-1" role="dialog" aria-labelledby="quoteTermModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="quoteTermModalLabel">Enter quote term body</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <form method="post" action="{{ url('quoteterms') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="term_archived" value="0">
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Term name</label>
                                <input type="text" class="form-control" id="termName" name="term_name"
                                    placeholder="14 day account">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-sm">
                                <label for="input">Quote terms description</label>
                                <textarea class="form-control" id="termBody" name="term_body" rows="10"
                                    placeholder="Payment must be made within 14 days"></textarea>
                            </div>
                        </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Quote Terms</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div id="active_div">
    <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Quote terms</p>
            </div>

            <div class="col-sm-5">
                    <input type="text" class="form-control float-left" id="active_input" onkeyup="activeFunction()"
                        placeholder="Search term name">
                </div>
        </div>
        <div class='table-responsive'>
            <table id="active_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortActive(0)">Term Name</th>
                        <th scope="col" onclick="sortActive(1)">Term Description</th>
                        <th scope="col" onclick="sortActive(2)">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quoteterms as $quoteterm)
                    @if($quoteterm->term_archived == '0')
                    <tr>
                        <td>{{ $quoteterm->term_name }}</td>
                        <td>{{ $quoteterm->term_body }}</td>
                        <td><a href="{{action('QuoteTermController@edit', $quoteterm['pk_term_id'])}}">Edit</a></td>
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
                <p class="h2">Archived Quote Terms</p>
            </div>

            <div class="col-sm-5">
                    <input type="text" class="form-control float-left" id="archived_input" onkeyup="archivedFunction()"
                        placeholder="Search term name">

            </div>
        </div>
        <div class='table-responsive'>
            <table id="archived_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col" onclick="sortArchived(0)">Term Name</th>
                        <th scope="col" onclick="sortArchived(1)">Term Description</th>
                        <th scope="col" onclick="sortArchived(2)">Edit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quoteterms as $quoteterm)
                    @if($quoteterm->term_archived == '1')
                    <tr>
                        <td>{{ $quoteterm->term_name }}</td>
                        <td>{{ $quoteterm->term_body }}</td>
                        <td><a href="{{action('QuoteTermController@edit', $quoteterm['pk_term_id'])}}">Edit</a></td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    @stop
