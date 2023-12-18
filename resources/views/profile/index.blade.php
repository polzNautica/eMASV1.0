@extends('layouts.app-master')

@section('content')
    @include('layouts.partials.messages')

    <div class="bg-light p-md-5 p-2 rounded">
        <h1 class="mb-3">Profile Information</h1>
        @auth
        <div class="container">
            <div class="row justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="card mx-md-5 webwidth70">
                        <div class="card-header" style="background-color: rgba(201,35,75,1)">
                        <h4 class="mb-0 py-1 text-white">User Information</h4></div>
                        <div class="mb-3 row d-flex justify-content-center mt-3">
                            {{-- <label for="profile_picture" class="form-label col-md-2">Profile Picture</label> --}}
                            <input type="file" class="form-control col" id="profile_picture" name="profile_picture" style="display: none;">
                            <label for="profile_picture" class="profile-picture-label col-md-2">
                                @if(isset($userDetails->profile_picture) && Storage::disk('public')->exists($userDetails->profile_picture))
                                    <img src="{{ asset('storage/' . $userDetails->profile_picture) }}" alt="Profile Picture" class="rounded-circle profile-picture" style="width: 80px; height: 80px;">
                                @else
                                    <!-- Default or placeholder profile picture -->
                                    <img src="assets/images/emas_profile_picture.png" alt="Default Profile Picture" class="rounded-circle profile-picture" style="width: 80px; height: 80px;">
                                @endif
                            </label>
                        </div>
                        <div class="card-body px-md-5 px-4">
                            <form method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('put')

                                <!-- Add input fields for user information (e.g., name, email, etc.) -->
                                <div class="form-group row mb-3">
                                    <label for="full_name" class="form-label col-md-2">Full Name</label>
                                    <input type="text" class="form-control col" id="full_name" name="full_name" value="{{ $userDetails->full_name ?? ''}}">
                                </div>

                                <div class="mb-3 row">
                                    <label for="ic" class="form-label col-md-2">I/C Number</label>
                                    <input type="text" class="form-control col" id="ic" name="ic" value="{{ $userDetails->ic ?? '' }}">
                                </div>
                                
                                <div class="mb-3 row">
                                    <label for="phone_number" class="form-label col-md-2">Phone Number</label>
                                    <input type="text" class="form-control col" id="phone_number" name="phone_number" value="{{ $userDetails->phone_number ?? '' }}">
                                </div>
                                
                                <div class="mb-3 row">
                                    <label for="date_of_birth" class="form-label col-md-2">Date of Birth</label>
                                    <input type="date" class="form-control col" {--style="max-width: 55%;"--} id="date_of_birth" name="date_of_birth" value="{{ $userDetails->date_of_birth ?? '' }}">
                                </div> 
                                
                                <div class="mb-3 row">
                                    <label for="gender" class="form-label col-md-2">Gender</label>
                                    <select class="form-select col" id="gender" name="gender">
                                        <option value="" {{ (isset($userDetails) && $userDetails->gender == '') ? 'selected' : '' }}>-Please Select-</option>
                                        <option value="male" {{ (isset($userDetails) && $userDetails->gender == 'male') ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ (isset($userDetails) && $userDetails->gender == 'female') ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>

                                <div class="mb-3 row">
                                    <label for="religion" class="form-label col-md-2">Religion</label>
                                    <input type="text" class="form-control col" id="religion" name="religion" value="{{ $userDetails->religion ?? '' }}">
                                </div>
     
                                <div class="mb-3 row">
                                    <label for="nationality" class="form-label col-md-2">Nationality</label>
                                    <select class="form-select col" id="nationality" name="nationality">
                                        <option value="" {{ (isset($userDetails) && $userDetails->nationality == '') ? 'selected' : '' }}>-Please Select-</option>
                                        <option value="Malaysian" {{ (isset($userDetails) && $userDetails->nationality == 'Malaysian') ? 'selected' : '' }}>Malaysian</option>
                                        <option value="Other" {{ (isset($userDetails) && $userDetails->nationality == 'Other') ? 'selected' : '' }}>Other</option>
                                    </select>
                                </div>

                                <div class="mb-3 row">
                                    <label for="ic" class="form-label col-md-2">Address</label>
                                    <div class="col px-0">
                                        <input type="text" class="form-control mb-1" id="address1" name="address1" value="{{ $userDetails->address1 ?? '' }}">
                                        <input type="text" class="form-control mb-1" id="address2" name="address2" value="{{ $userDetails->address2 ?? '' }}">
                                        <input type="text" class="form-control" id="address3" name="address3" value="{{ $userDetails->address3 ?? '' }}">    
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <label for="username" class="form-label col-md-2">Username</label>
                                    <input type="text" class="form-control col" id="username" name="username" value="{{ auth()->user()->username }}" readonly>
                                </div>

                                <div class="mb-3 row">
                                    <label for="email" class="form-label col-md-2">Email</label>
                                    <input type="email" class="form-control col" id="email" name="email" value="{{ auth()->user()->email }}" readonly>
                                </div>

                                <div class="d-flex" style="justify-content: flex-end"> 
                                    <button type="submit" class="btn btn-warning">Update Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endauth
    </div>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var profilePictureLabel = document.querySelector('.profile-picture-label');
        var profilePictureInput = document.getElementById('profile_picture');

        if (profilePictureLabel && profilePictureInput) {
            profilePictureLabel.addEventListener('click', function () {
                profilePictureInput.click();
            });
        }
    });
</script>

@endsection
@endsection
