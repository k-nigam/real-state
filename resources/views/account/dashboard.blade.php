@extends('layouts.app')

@section('title', 'Dashboard - Real Estate')

@section('content')

<div class="auth-container">

    <h1>Welcome, {{ auth()->user()->name }}</h1>

    <p>Welcome to your Real Estate account.</p>

    <hr>

    <p>
        <strong>Email:</strong>
        {{ auth()->user()->email }}
    </p>

    <p>
        <strong>Phone:</strong>
        {{ auth()->user()->phone }}
    </p>

    <p>
        <strong>Account Status:</strong>
        {{ ucfirst(auth()->user()->status) }}
    </p>

    <div class="links">
        <a href="{{ route('account.profile') }}">
            My Profile
        </a>
    </div>

    <div class="links">
        <a href="#">
            My Enquiries
        </a>
    </div>

    <div class="links">
        <a href="{{ route('account.properties.create') }}">
            Submit Your Property
        </a>
    </div>

    <div class="links">
        <a href="{{ route('account.properties.index') }}">
            My Listings
        </a>
    
        <a href="{{ route('account.properties.create') }}">
            Submit Your Property
        </a>
    </div>

    <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
        @csrf

        <button type="submit">
            Logout
        </button>
    </form>

</div>

@endsection
