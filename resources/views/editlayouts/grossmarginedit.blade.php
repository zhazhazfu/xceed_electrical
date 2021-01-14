@extends('layouts.app')

@section('title', 'Gross Margin')

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
            <h3>Edit Gross Margin</h3>
            <script>
            function showSelected(element){
               optionSelected = element.value;
            document.getElementById('gm_rate').value = optionSelected;
              } 
              </script>
    
            <form method="post" action="{{action('GrossMarginController@update', $pk_gm_id)}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <h5>GM percentage</h5>
                <div class="form-group">
                    <select class='form-control'  id="gm_percentage" name="gm_percentage" onchange="showSelected(this)">
                    <option value="" selected disabled>Please select a Gross Margin</option>
                    <option value="1.111">10</option>
                    <option value="1.143">12.5</option>
                    <option value="1.176">15</option>
                    <option value="1.25">20</option>
                    <option value="1.29">22.5</option>
                    <option value="1.333">25</option>
                    <option value="1.379">27.5</option>
                    <option value="1.429">30</option>
                    <option value="1.481">32.5</option>
                    <option value="1.538">35</option>
                    <option value="1.6">37.5</option>
                    <option value="1.667">40</option>
                    <option value="1.739">42.5</option>
                    <option value="1.818">45</option>
                    <option value="1.905">47.5</option>
                    <option value="2">50</option>
                    <option value="2.1092">52.5</option>
                    <option value="2.223">55</option>
                    <option value="2.3529">57.5</option>
                    <option value="2.5">60</option>
                    <option value="2.666">62.5</option>
                    <option value="2.852">65</option>
                    <option value="3.075">67.5</option>
                    <option value="3.333">70</option>
                    <option value="4">75</option>
                    <option value="5">80</option>
                    <option value="6.667">85</option>
                    </select>

                <div class="form-group">
                <label for="inputGrossMargin"><h5>GM Rate</h5></label>
               <input type="input" class="form-control" id="gm_rate" placeholder="Gross Margin" readonly  name="gm_rate">
               </div>

                <div class="form-group">
                    <a class="btn btn-secondary" href="{{url('/grossmargin')}}">Cancel</a>
                    <input type="submit" class="btn btn-primary" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
@endif
@stop
