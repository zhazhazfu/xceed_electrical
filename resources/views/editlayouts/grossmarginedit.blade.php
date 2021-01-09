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
            <h6>Please note: Choose the matching percentage and rate (E.G. 42.5% 1.739)</h6>
            <form method="post" action="{{action('GrossMarginController@update', $pk_gm_id)}}">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PATCH">
                <h5>GM percentage</h5>
                <div class="form-group">
                    <select class='form-control' id="gm_percentage" name="gm_percentage">
                        <option>10</option>
                        <option>12.5</option>
                        <option>15</option>
                        <option>20</option>
                        <option>22.5</option>
                        <option>25</option>
                        <option>27.5</option>
                        <option>30</option>
                        <option>32.5</option>
                        <option>35</option>     
                        <option>37.5</option>
                        <option>40</option>
                        <option selected>42.5</option>
                        <option>45</option>
                        <option>47.5</option>
                        <option>50</option>
                        <option>52.5</option>
                        <option>55</option>
                        <option>57.5</option>
                        <option>60</option>
                        <option>62.5</option>
                        <option>65</option>
                        <option>67.5</option>
                        <option>70</option>
                        <option>75</option>
                        <option>80</option>
                        <option>85</option>
                    </select>
                </div>
                <h5>GM Rate</h5>
                <div class="form-group">
                    <select class='form-control' id="gm_rate" name="gm_rate">
                        <option>1.111</option>
                        <option>1.143</option>
                        <option>1.176</option>
                        <option>1.25</option>
                        <option>1.29</option>
                        <option>1.333</option>
                        <option>1.379</option>
                        <option>1.429</option>
                        <option>1.481</option>
                        <option>1.538</option>     
                        <option>1.6</option>
                        <option>1.667</option>
                        <option selected>1.739</option>
                        <option>1.818</option>
                        <option>1.905</option>
                        <option>2</option>
                        <option>2.1092</option>
                        <option>2.223</option>
                        <option>2.3529</option>
                        <option>2.5</option>
                        <option>2.666</option>
                        <option>2.852</option>
                        <option>3.075</option>
                        <option>3.333</option>
                        <option>4</option>
                        <option>5</option>
                        <option>6.667</option>
                    </select>
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
