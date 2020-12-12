@extends('layouts.app')

@section('title', 'Login')

@section('content')

<!-- Button trigger modal -->
<div class=" p-3 mb-5 bg-white rounded border">
    <div>

        @if($message = Session::get('error'))
        <div class="alert alert-danger alert-block">
            <button type="button" class="close" data-dismiss="alert">x</button>
            <strong>{{ $message }}</strong>
        </div>
        @endif

        @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
    </div>

    <div class="row">
        <div class="col-sm">
            <h3>Success Login</h3>
            @if(isset(Auth::user()->user_name))
            <div class="alert alert-danger success-block">
                <strong>Welcome {{ Auth::user()->user_name }}</strong>
                <a href="{{ url('/main/logout') }}">Logout</a>
            </div>
            @else
            <script>
                window.location = "/main";

            </script>
            @endif
        </div>
    </div>
</div>

@stop
