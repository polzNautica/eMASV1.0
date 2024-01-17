@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('password.email') }}">
        @csrf

        {{-- <h1 class="h3 fw-normal">Forgot Password</h1> --}}

        @include('layouts.partials.messages')

<div class="d-flex justify-content-center bg-light rounded mx-5 p-3">
    <div class="col-lg-6">
        <div class="form-group form-floating mb-3">
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required="required">
            <label for="floatingEmail">Email</label>
        </div>

        <button class="w-100 btn btn-lg btn-warning" type="submit">Send Password Reset Link</button>
    </form>

    @include('auth.partials.copy')
</div>
</div>
@endsection
