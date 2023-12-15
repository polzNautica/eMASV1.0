{{-- @extends('layouts.app-master')

@section('content')
@include('layouts.partials.messages')

<div class="bg-light p-5 rounded">
    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('put')
        <!-- Add input fields for user information (e.g., name, email, etc.) -->
        <input type="text" name="name" value="{{ auth()->user()->name }}">
        <input type="email" name="email" value="{{ auth()->user()->email }}">
        <!-- Add more input fields as needed -->
        <button type="submit">Update Profile</button>
    </form>
</div>

@endsection --}}
