@extends('layouts.app')

@section('title', 'Register - Real Estate')

@section('content')

<div class="auth-container">

    <h1>Create Account</h1>

    <p>Register to continue.</p>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <div class="form-group">
            <label for="name">Name</label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required
                autocomplete="name"
            >
        </div>

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
            <label for="phone">Phone</label>

            <input
                type="tel"
                id="phone"
                name="phone"
                value="{{ old('phone') }}"
                required
                autocomplete="tel"
            >
        </div>

        <div class="form-group">
            <label for="password">Password</label>

            <input
                type="password"
                id="password"
                name="password"
                required
                autocomplete="new-password"
            >
        </div>

        <div class="form-group">
            <label for="password_confirmation">
                Confirm Password
            </label>

            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                required
                autocomplete="new-password"
            >
        </div>

        <button type="submit">
            Register
        </button>
    </form>

    <div class="links">
        Already have an account?
        <a href="{{ route('login') }}">Login</a>
    </div>

</div>

@endsection
