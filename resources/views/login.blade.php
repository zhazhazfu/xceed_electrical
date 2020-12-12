@extends('layouts.app')

@section('title', 'Login')

@section('content')

<!-- Button trigger modal -->
<div>

</div>

<div class="cotainer mt-5">
    <div class="row justify-content-center">
        <div class="col-md-3 mt-5">
            <img src="images/Xceed_logo_small_01-copy1.png" class="img-fluid mx-auto mb-5" style="display:block"
                width="350px" alt="Responsive image">
            @if(isset(Auth::user()->user_name))
            <script>
                window.location = "/main/successlogin";

            </script>
            @endif
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
            <div class="card">
                <div class="card-header">Login</div>
                <div class="card-body">
                    <form method="post" action="{{ url('/main/checklogin') }}">
                        {{csrf_field()}}
                        <div class="form-group row">
                            <label for="email_address" class="col-md-4 col-form-label text-md-right">Username</label>
                            <div class="col-sm-6">
                                <input type="text" id="user_name" class="form-control" name="user_name" required
                                    autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-sm-6">
                                <input type="password" id="password" class="form-control" name="user_password" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember"> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 offset-sm-5">
                            <button type="submit" class="btn btn-primary">
                                Login
                            </button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@stop
