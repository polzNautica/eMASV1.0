@extends('layouts.app-master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header py-3 px-4"><h1>404 - Not Found</h1></div>

                <div class="card-body">
                    <p class="lead">The page you are looking for could not be found.</p>
                    <a class="btn btn-warning" href="{{ url('/') }}">Return to the homepage</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
