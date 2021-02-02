@extends('layouts.app')

@section('title', 'exclusions')

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

<a href="/{{ 'qdash' }}" type="button" class="btn btn-secondary float-right ml-3">Back</a>
<button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal"data-target="#exclusionModal">Add Exclusion</button>

<div class="modal fade" id="exclusionModal" tabindex="-1" role="dialog" aria-labelledby="exclusionModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exclusionModalLabel">Enter Exclusion</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('exclusions') }}">
                    {{ csrf_field() }}

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input">Title</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                </div>
                                <input type="text" class="form-control"
                                    name="exclusion_name">
                            </div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input">Description</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                </div>
                                <textarea type="text" class="form-control"
                                    name="exclusion_Content"></textarea>
                            </div>
                        </div>
                    </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="Submit" class="btn btn-primary">Save Exclusion</button>
            </div>
                </form>
        </div>
    </div>
</div>

    <div id="active_div">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Exclusions</p>
            </div>

        </div>

        <div class='table-responsive'>
            <table id="active_table" class="display table table-hover table-sm">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Exclusion Name</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($exclusions as $Exclusions)
                    <tr>
                        <td>{{ $Exclusions->exclusion_name}}</td>
                        <td>{{ $Exclusions->exclusion_Content }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
   
@stop