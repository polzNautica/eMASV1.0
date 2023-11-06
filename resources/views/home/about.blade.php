@extends('layouts.app-master')

@section('activeAbout')
active
@endsection

@section('content')
@include('layouts.partials.messages')
    <div class="bg-light p-5 rounded">
        <h1>About Us</h1>
        <p class="lead">Anyone can see this page, its public.</p>
        {{-- @auth
        <h1>Dashboard</h1>
        <h5>Welcome, {{ Auth::user()->username }}!</h5>
        <p class="lead">Only authenticated users can access this section.</p>
        @endauth

        @guest
        <h1>Homepage</h1>
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest --}}
    </div>
@endsection