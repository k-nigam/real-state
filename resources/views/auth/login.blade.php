@extends('layouts.app')

@section('title', 'Login - Real Estate')

@section('content')

<div class="auth-container">

    <h1>Login</h1>

    <p>Login to your account.</p>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('login.store') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email</label>

            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                required
                autocomplete="email"
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                required
                autocomplete="current-password"
            >
        </div>

        <div class="form-group">
            <label>
                <input
                    type="checkbox"
                    name="remember"
                    value="1"
                    style="width:auto"
                >
                Remember me
            </label>
        </div>

        <button type="submit">
            Login
        </button>
    </form>

    <div class="links">
        <a href="{{ route('password.request') }}">
            Forgot password?
        </a>
    </div>

    <div class="links">
        Don't have an account?
        <a href="{{ route('register') }}">Register</a>
    </div>

</div>

@endsection
