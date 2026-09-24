@extends('layouts.app')

@section('title', 'My Profile - Real Estate')

@section('content')

<div class="auth-container">

    <h1>My Profile</h1>

    <p>
        <strong>Name:</strong>
        {{ auth()->user()->name }}
    </p>

    <p>
        <strong>Email:</strong>
        {{ auth()->user()->email }}
    </p>

    <p>
        <strong>Phone:</strong>
        {{ auth()->user()->phone }}
    </p>

    <p>
        <strong>Status:</strong>
        {{ ucfirst(auth()->user()->status) }}
    </p>

    <div class="links">
        <a href="{{ route('dashboard') }}">
            ← Back to Dashboard
        </a>
    </div>

</div>

@endsection
