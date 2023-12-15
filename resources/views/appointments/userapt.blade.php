@extends('layouts.app-master')

@section('activeMakeApt')
active
@endsection

@section('content')
@include('layouts.partials.messages')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <h5>Welcome, {{ Auth::user()->username }}!</h5>
        <p class="lead">Only authenticated users can access this section.</p>
        @endauth
@endsection