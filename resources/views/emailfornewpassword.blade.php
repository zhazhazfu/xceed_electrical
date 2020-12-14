@extends('layouts.app')

@section('title', 'Email for new Password')

@section('content')

<!-- resources/views/auth/password.blade.php -->
<html>
<head>
    <title>Reset Password Blade Page</title>
</head>
<body>
    <h1>Reset Password</h1>
<form method="POST" action="/password/email">
    {!! csrf_field() !!}

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
        <button type="submit">
            Send Password Reset Link
        </button>
    </div>
</form>
</body>
</html>
@endsection
