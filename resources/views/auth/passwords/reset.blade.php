@extends('layouts.auth-master')

@section('content')
    <form method="post" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">
        <input type="hidden" name="email" value="{{ $email }}">
        
        @include('layouts.partials.messages')

        <div class="d-flex justify-content-center bg-light rounded mx-5 p-3">
            <div class="col-lg-6">
                {{-- <div class="form-group form-floating mb-3">
                    <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
                    <label for="floatingEmail">Email</label>
                </div> --}}

                <div class="form-group form-floating mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <label for="floatingPassword">Password</label>
                </div>

                <div class="form-group form-floating mb-3">
                    <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    <label for="floatingConfirmPassword">Confirm Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-warning" type="submit">Reset Password</button>
            </div>
        </div>
    </form>
@endsection
