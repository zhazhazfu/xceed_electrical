@extends('layouts.app')

@section('title', 'Prefix')

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
<button type="button" class="btn btn-primary float-right ml-3" data-toggle="modal" data-target="#quotetermsModal">Add prefix</button>

<div class="modal fade" id="quotetermsModal" tabindex="-1" role="dialog" aria-labelledby="quotetermsModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="quotetermsModalLabel">Enter Prefix</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ url('prefix') }}">
                    {{ csrf_field() }}
                
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input">Prefix</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                </div>
                                <input type="text" class="form-control"
                                    name="prefix">
                            </div>
                        </div>
                        
                    </div>
                     {{-- <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="input">Description</label>
                            <div class="input-group mb-2">
                                <div class="input-group-prepend">
                                </div> 
                               
                                    <div class="form-group">
                                      <label for=""></label>
                                      <textarea class="form-control" name="term_body" type="text" class="form-control" rows="3"></textarea>
                                    </div>
                            </div>
                        </div>
                    </div> --}}
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="Submit" class="btn btn-primary">Save Prefix</button>
            </div>
                </form>
        </div>
    </div>
</div>


    <!-- End modal -->
    <div id="active_div">
        <div class="row mb-4">
            <div class="col-sm-7">
                <p class="h2">Prefixes</p>
            </div>
        </div>

        <div class='table-responsive'>
            <table id="active_table" class="display table table-hover table-sm">
                <thead>
                    <tr>
                        <th scope="col">Prefix</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($prefixes as $pre)
                    <tr>
                        <td>{{ $pre->prefix }}</td>
                        {{-- <td>{{ $QuoteTerm->term_body }}</td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
   
@stop

