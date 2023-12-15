@extends('layouts.app-master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-3 px-4   "><h1>403 - Access Denied</h1></div>

                <div class="card-body">
                    <p class="lead">You do not have permission to access this page.</p>
                    <a class="btn btn-warning" href="{{ url('/') }}">Return to the homepage</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
