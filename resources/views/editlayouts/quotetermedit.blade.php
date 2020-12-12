@extends('layouts.app')

@section('title', 'Quote Terms')

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
            <h3>Edit Quote Term</h3>
            <form method="post" action="{{action('QuoteTermController@update', $pk_term_id)}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <input type="hidden" name="term_archived" value="0">
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Term name</label>
                        <input type="text" class="form-control" id="termName" name="term_name"
                            value="{{$quoteterms->term_name}}">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Quote terms description</label>
                        <textarea class="form-control" id="termBody" name="term_body"
                            placeholder="{{$quoteterms->term_body}}" value="{{$quoteterms->term_body}}"
                            rows="10">{{$quoteterms->term_body}}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-sm">
                        <label for="input">Archived</label>
                        <select id="term_archived" name="term_archived" class="form-control">
                            @if ($quoteterms->term_archived == 0)
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
                    <a class="btn btn-secondary" href="{{url('/quoteterms')}}">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
@stop
