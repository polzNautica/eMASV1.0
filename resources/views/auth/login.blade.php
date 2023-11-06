@extends('layouts.auth-master')

@section('title')
    eMAS Login
@endsection

@section('content')
<div class="d-flex justify-content-center bg-light rounded mx-5 p-3">
    <div class="col-lg-6">
        <form method="post" action="{{ route('login.perform') }}">
        
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    
            @include('layouts.partials.messages')
    
            <div class="form-group form-floating mb-3">
                <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Username" required="required" autofocus>
                <label for="floatingName">Email or Username</label>
                @if ($errors->has('username'))
                    <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                @endif
            </div>
            
            <div class="form-group form-floating mb-3">
                <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Password" required="required">
                <label for="floatingPassword">Password</label>
                @if ($errors->has('password'))
                    <span class="text-danger text-left">{{ $errors->first('password') }}</span>
                @endif
            </div>
            <button class="w-100 btn btn-lg btn-warning" type="submit">Login</button>
    
            <p class="mt-3">
                <a href="{{ route('password.reset') }}">Forgot Password?</a>
            </p>        
            @include('auth.partials.copy')
        </form>
    </div>
   
</div>
    
@endsection