@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')

<!-- resources/views/auth/reset.blade.php -->
<html>
<head>
    <title>Reset Password Blade Page</title>
</head>
<body>
    <h1>Reset Password</h1>
<form method="POST" action="/password/reset">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $resetpassword ?? '' }}">

    @if (count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <div>
        Email
        <input type="email" name="email" value="{{ old('email') }}">
    </div>

    <div>
        Password
        <input type="password" name="password">
    </div>

    <div>
        Confirm Password
        <input type="password" name="password_confirmation">
    </div>

    <div>
        <button type="submit">
            Reset Password
        </button>
    </div>
</form>
</body>
</html>
@endsection