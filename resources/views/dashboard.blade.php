@extends('layouts.app')

@section('title', 'Dashboard - Real Estate')

@section('content')

<div>
    <h1>Welcome, {{ auth()->user()->name }}</h1>

    <p>You are logged in successfully.</p>

    <p>
        Email: {{ auth()->user()->email }}
    </p>

    <p>
        Phone: {{ auth()->user()->phone }}
    </p>

    <p>
        Account Status: {{ auth()->user()->status }}
    </p>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit">
            Logout
        </button>
    </form>
</div>

@endsection
