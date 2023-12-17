@extends('layouts.app-master')

@section('activeMakeApt')
active
@endsection

@section('content')
@include('layouts.partials.messages')
    <div class="bg-light p-md-5 rounded">
        @auth
        <h1 class="mb-3">Make an Appointment</h1>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="card mx-md-5">
                        <div class="card-header" style="background-color: rgba(201,35,75,1)">
                        <h4 class="mb-0 py-1 text-white">User Information</h4></div>
                        <div class="card-body">
                            {{-- @if(session('success'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif --}}
        
                            <form method="post" action="{{ route('appointments.store',['id' => $userDetails->user_id]) }}">
                                @csrf
                                <input type="hidden" name="form_id" value="{{ $form_id }}">
                                <div class="px-md-5 px-2">
                                    <div class="form-group d-none">
                                        <label for="username">Username</label>
                                        <input type="text" class="form-control" id="username" name="username" value="{{ $users->username ?? '' }}">
                                    </div>
            
                                    <div class="form-group row mb-3">
                                        <label class="col-md-2" for="full_name">Full Name</label>
                                        <input type="text" class="form-control col" id="full_name" name="full_name" value="{{ old('full_name', $userDetails->full_name ?? '') }}" required>
                                    </div>
            
                                    <div class="form-group row mb-3">
                                        <label class="col-md-2" for="email">Email</label>
                                        <input type="email" class="form-control col" id="email" name="email" value="{{ old('email', $users->email ?? '') }}" required>
                                    </div>
            
                                    <div class="form-group row mb-3">
                                        <label class="col-md-2" for="ic">I/C Number</label>
                                        <input type="text" class="form-control col" id="ic" name="ic" value="{{ old('ic', $userDetails->ic ?? '') }}" required>
                                    </div>
            
                                    <div class="form-group row mb-3">
                                        <label class="col-md-2" for="phone_number">Phone Number</label>
                                        <input type="text" class="form-control col" id="phone_number" name="phone_number" value="{{ old('phone_number', $userDetails->phone_number ?? '') }}" required>
                                    </div>
                                </div>                         
        
                                <div class="d-flex px-md-5" style="justify-content: flex-end"> 
                                    <button type="submit" class="btn btn-warning col-md-2 col-6 mb-3" style="">Save</button>
                                </div>
                            </form>
                            @if(strlen($userDetails->full_name) > 0 && strlen($userDetails->email) > 0 && strlen($userDetails->ic) > 0 && strlen($userDetails->phone_number) > 0)
                                <div class="d-flex px-md-5" style="justify-content: flex-end"> 
                                    <a href="{{ route('appointments.sicknessForm', ['form_id' => $form_id]) }}" class="btn btn-success col-md-2 col-6">Next</a>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


        @endauth
@endsection