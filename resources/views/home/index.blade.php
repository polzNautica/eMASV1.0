@extends('layouts.app-master')

@section('activeHome')
active
@endsection

@section('content')
@include('layouts.partials.messages')
    <div class="bg-light p-5 rounded">
        @auth
        <h1>Dashboard</h1>
        <h5>Welcome, {{ Auth::user()->username }}!</h5>
        <p class="lead">Only authenticated users can access this section.</p>
        {{-- <a class="btn btn-lg btn-primary" href="https://codeanddeploy.com" role="button">View more tutorials here &raquo;</a> --}}
        @endauth

        @guest
        <h1 class="mb-5">Welcome to eMedical Appointment System (eMAS)</h1>
        <div style="display: flex; flex-direction:row" class="mobilerowtocol mb-5"> 
            <img src="/assets/images/home1.jpg" alt="homeimg1" class="px-2" style="max-height: 50vh; border:2px">
            <p class="lead" style="display:flex; padding:0 0.5rem">At eMAS, we understand that student well-being is a top priority. 
                That's why we've developed a convenient and efficient medical appointment system 
                tailored specifically for our students. Whether you're feeling under the weather 
                or in need of healthcare services, our user-friendly platform is here to streamline 
                the process and prioritize your health.</p>
        </div>
        <div>
            <h3>Why eMAS?</h3>
            <div class="mobilerowtocol col-md-12" style="display: flex; flex-direction:row">
                <div class="card mt-3 mx-2" style="border:0">
                    <div class="card-body">
                      <h5 class="card-title">Seamless Scheduling</h5>
                      <p class="card-text">Say goodbye to long waiting times! 
                        Our intuitive system allows you to book medical 
                        appointments seamlessly. Whether you need to see a doctor, 
                        nurse, or specialist, simply log in and schedule your appointment at your convenience.
                      </p>
                    </div>
                </div>
                <div class="card mt-3 mx-2" style="border:0">
                    <div class="card-body">
                      <h5 class="card-title">Personalized Care</h5>
                      <p class="card-text">At PKU, we believe in personalized healthcare. 
                        Our medical professionals are dedicated to understanding your 
                        unique needs and providing the best possible care. The appointment 
                        system ensures that you get the attention you deserve, with the 
                        option to choose your preferred healthcare provider. </p>
                    </div>
                </div>
            </div>
            <div class="mobilerowtocol" style="display: flex; flex-direction:row">
                <div class="card mt-3 mx-2" style="border:0">
                    <div class="card-body">
                      <h5 class="card-title">Timely Reminders</h5>
                      <p class="card-text">Never miss an appointment again! Our system sends 
                        timely reminders to keep you informed about upcoming medical visits. 
                        Stay on top of your health and wellness with automated notifications 
                        via email.</p>
                    </div>
                </div>
                <div class="card mt-3 mx-2" style="border:0">
                    <div class="card-body">
                      <h5 class="card-title">Accessible Anytime, Anywhere</h5>
                      <p class="card-text">Need to schedule an appointment outside 
                        regular hours? No problem. Our system is accessible 24/7, 
                        allowing you to book, reschedule, or cancel appointments 
                        whenever it suits you. Your health is our priority, and we're 
                        here to make it easy for you.</p>
                    </div>
                </div>
            </div>
        </div>
            
        
        @endguest
    </div>
@endsection